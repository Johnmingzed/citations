<?php

namespace Core\HTML;

/**
 * Class FormSelect
 *
 * This class represents a select dropdown form element.
 */
class FormSelect extends FormElement
{
    /**
     * FormSelect constructor.
     *
     * @param array       $attributes An associative array of attributes to set for the select element.
     * @param string|null $label      The label text for the select element. (optional)
     */
    public function __construct(array $attributes, ?string $label = null)
    {
        $this->setType('select');

        foreach ($attributes as $k => $v) {
            $this->setAttribute($k, $v);
        }
    }

    /**
     * Adds options to the select element.
     *
     * @param array $options An array of options to add to the select element.
     */
    public function addOptions(array $options)
    {
        foreach ($options as $option) {
            $selected = false;

            if (isset($option[2])) {
                $selected = true;
            }

            $this->addOption(
                $option[0],
                $option[1],
                $selected
            );
        }
    }

    /**
     * Adds an option to the select element.
     *
     * @param string $name     The name of the option.
     * @param string $value    The value of the option.
     * @param bool   $selected Whether the option is selected. (optional)
     */
    public function addOption(string $name, string $value, bool $selected = false)
    {
        $this->options[] = ['name' => $name, 'value' => $value, 'selected' => $selected];
    }
}
