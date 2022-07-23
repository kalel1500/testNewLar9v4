<?php

namespace App\View\Components\Cards;

use Illuminate\View\Component;

class Simple extends Component
{
    public $bodyClass;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($bodyClass = null)
    {
        $this->bodyClass = $bodyClass;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cards.simple');
    }
}
