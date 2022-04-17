<?php

namespace App\View\Components;

use Illuminate\View\Component;

class hargaModalInput extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $label, $name, $value, $placeholder;
    public function __construct($label, $name, $value, $placeholder)
    {
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.harga-modal-input');
    }
}
