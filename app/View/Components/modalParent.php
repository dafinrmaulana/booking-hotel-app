<?php

namespace App\View\Components;

use Illuminate\View\Component;

class modalParent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $id;
    public $ariaLabelledby;
    public $modalSize;
    public function __construct($modalSize, $ariaLabelledby, $id)
    {
        $this->id = $id;
        $this->ariaLabelledby = $ariaLabelledby;
        $this->modalSize = $modalSize;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal-parent');
    }
}
