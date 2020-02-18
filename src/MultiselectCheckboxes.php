<?php
namespace Nova\MultiselectCheckboxes;

use Laravel\Nova\Fields\Field;

class MultiselectCheckboxes extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'novamultiselectcheckboxes';

    /**
     * Set the options for the select menu.
     *
     * @param array $options
     * @param array $selected selectedIds
     *
     * @return $this
     */
    public function options($options, $selected = NULL)
    {
        
        $selections = $selected ?? [];

        return $this->withMeta([
            'options' => collect($options ?? [])->map(function ($label, $value) use ($selections) {
                return [
                    'id' => $value,
                    'label' => $label,
                    'selected' => in_array($value, $selections),
                ];
            })->values()->all(),
            'selection' => $selected 
        ]);
    }

    /**
     * Sets the placeholder value displayed on the field.
     *
     * @param string $placeholder
     * 
     **/
    public function placeholder($placeholder)
    {
        return $this->withMeta(['placeholder' => $placeholder]);
    }

    /**
     * Sets the placeholder value displayed on the field.
     *
     * @param string $placeholder
     * 
     **/
    public function returnUnchecked()
    {
        return $this->withMeta(['returnUnchecked' => true]);
    }
}
