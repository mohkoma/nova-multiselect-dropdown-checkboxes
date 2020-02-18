<template>
    <ul>
        <li v-for="option in field.options" :key="option.id">
            <span >{{ option.label }}</span>
        </li>
    </ul>
</template>

<script>
    export default {
        props: ['resourceName', 'field'],
    }
</script>
