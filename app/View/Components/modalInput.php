<?php

namespace App\View\Components;

use Illuminate\View\Component;

class modalInput extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $name, $label, $type, $value, $class;
    public function __construct($name, $label, $type, $value, $class)
    {
        $this->name = $name;
        $this->label = $label;
        $this->type = $type;
        $this->value = $value;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal-input');
    }
}
