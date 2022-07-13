<?php

namespace App\View\Components\Navbar;

use Illuminate\View\Component;

class AllLinks extends Component
{
    public $isForMobileMenu;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($isForMobileMenu = false)
    {
        $this->isForMobileMenu  = $isForMobileMenu;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.navbar.all-links');
    }
}
