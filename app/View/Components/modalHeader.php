<?php

namespace App\View\Components;

use Illuminate\View\Component;

class modalHeader extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $titleHeader;
    public $idHeader;
    public function __construct($titleHeader, $idHeader)
    {
        $this->titleHeader = $titleHeader;
        $this->idHeader = $idHeader;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal-header');
    }
}
