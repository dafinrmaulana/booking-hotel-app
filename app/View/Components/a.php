<?php

namespace App\View\Components;

use Illuminate\View\Component;

class a extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $class, $dataId, $title, $href;
    public function __construct($class, $dataId, $title, $href)
    {
        $this->class = $class;
        $this->dataId = $dataId;
        $this->title = $title;
        $this->href = $href;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.action');
    }
}
