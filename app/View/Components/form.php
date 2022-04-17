<?php

namespace App\View\Components;

use Illuminate\View\Component;

class createForm extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $bajak, $method, $action, $id;
    public function __construct($action, $method, $bajak, $id)
    {
        $this->bajak = $bajak;
        $this->method = $method;
        $this->action = $action;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form');
    }
}
