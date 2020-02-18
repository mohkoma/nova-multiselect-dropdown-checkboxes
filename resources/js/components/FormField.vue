<template>
    <default-field :field="field" :errors="errors" >
        
        <template slot="field">

            <div class="w-full max-col-2 relative" v-click-outside="() => isOpen = false">

                <!-- Select field -->
                <div tabindex="0" class="flex items-center form-control form-select pr-6" @click.prevent="isOpen = true" @focus.prevent="isOpen = true">
                    <div class="flex items-center">
                        {{ field.placeholder || field.name }}
                    </div>
                </div>

                <!-- Loop through options -->

                <div class="absolute rounded-lg bg-white shadow border border-60 my-2 w-full" style="z-index: 100" v-if="isOpen">
                    <div class="overflow-auto rounded-b-lg rounded-t-lg cursor-tex py-4 px-4 form-input" style="max-height: 15rem">

                        <div v-for="(option, index) in field.options" :key="option.id" class="flex mb-2">
                            
                            <!-- Checkboxes -->

                            <checkbox
                                :value="option.id"
                                :checked="option.selected"
                                @input="toggleOption(index)"
                                class="mr-2"/>

                            <!-- The label -->

                            <label
                                :for="field.name"
                                v-text="option.label"
                                @click="toggleOption(index)"
                                class="w-full"
                            ></label>

                        </div>
                    </div>
                </div>

            </div>

        </template>

    </default-field>
</template>

<script>

import { FormField, HandlesValidationErrors } from 'laravel-nova'
import vClickOutside from 'v-click-outside'

export default {
    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field'],

    directives: {
      clickOutside: vClickOutside.directive
    },

    data() {
        return {
            isOpen: false
        }
    },

    methods: {
        /*
         * Set the initial, internal value for the field.
         */
        setInitialValue() {

            // Selected ids
            let array = [];

            // Use the field default value
            if(!this.field.selection) {

                // Validation of array
                if(Array.isArray(this.field.value)) {
                    array = this.field.value;
                } else if(this.field.value) {
                    array = this.field.value.split(',').map(id => Number(id));
                }

                // Check the selections
                this.field.options.forEach(option => {

                    let selected = false;
                    if(array.includes(option.id)) {
                        selected = this.field.returnUnchecked ? false : true;
                    } else {
                        selected = this.field.returnUnchecked ? true : false;
                    }

                    option.selected = selected;

                });

            } else {
                array = this.field.selection.map;
            }

            // Set the value
            this.value = array;
            
        },

        /*
         * Toggle options.
         */
        toggleOption(index) {

            if(this.value.includes(this.field.options[index].id)) {

                // Set the boolean
                this.field.options[index].selected = this.field.returnUnchecked ? true : false;

                // Delete the target if else
                this.value = this.value.filter(item => item != this.field.options[index].id);

            } else {


                // Set the boolean
                this.field.options[index].selected = this.field.returnUnchecked ? false : true;

                // Push to the value
                this.value.push(this.field.options[index].id)
            }
        },

        /**
         * Fill the given FormData object with the field's internal value.
         */
        fill(formData) {
            formData.append(this.field.attribute, this.value || '')
        },

        /**
         * Update the field's internal value.
         */
        handleChange(value) {
            this.value = value
        },
    },
}
</script>
