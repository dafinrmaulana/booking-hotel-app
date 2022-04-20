<?php

namespace App\View\Components;

use Illuminate\View\Component;

class button extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $dataDismiss, $class, $type, $desc, $icon;
    public function __construct($desc, $type, $class, $dataDismiss)
    {
        $this->desc = $desc;
        $this->type = $type;
        $this->class = $class;
        $this->dataDismiss = $dataDismiss;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button');
    }
}
