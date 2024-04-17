<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectBox extends Component
{
    /**
     * Create a new component instance.
     */
    public $value;
    public $name;
    public $placeholder;
    public $values;
    public $extraLabelClass;
    public $extraClass;
    public $endpoint;
    public $field1;
    public $field2;
    public $required;
    public $optionText;
    public $removeTextSelection;
    public $multiple;
    public $multipleValues;
    public $noSelectOption;
    public $selectedValues;

    public function __construct($value = '', $name, $placeholder, $values = [], $extraLabelClass = '', $extraClass = '', $endpoint = '', $field1 = '', $field2 = '', $required = false, $optionText = '', $removeTextSelection = false, $multiple = false, $multipleValues = '', $noSelectOption = "true", $selectedValues = '')
    {
        $this->value = $value;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->values = $values;
        $this->extraLabelClass = $extraLabelClass;
        $this->extraClass = $extraClass;
        $this->endpoint = $endpoint;
        $this->field1 = $field1;
        $this->field2 = $field2;
        $this->required = $required;
        $this->optionText = $optionText;
        $this->removeTextSelection = $removeTextSelection;
        $this->multiple = $multiple;
        $this->multipleValues = $multipleValues;
        $this->noSelectOption = $noSelectOption;
        $this->selectedValues = $selectedValues;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select-box');
    }
}
