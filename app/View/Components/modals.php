<?php

namespace App\View\Components;

use Illuminate\View\Component;

class modals extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $id;
    public $title;
    public $form;

    public function __construct($id,$title,$form)
    {
        $this->id = $id;
        $this->title = $titles;
        $this->form = $form;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modals');
    }
}
