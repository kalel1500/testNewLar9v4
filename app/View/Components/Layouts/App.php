<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;

class App extends Component
{
    public bool $clear;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($clear = false)
    {
        $this->clear = $clear;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layouts.app');
    }
}
