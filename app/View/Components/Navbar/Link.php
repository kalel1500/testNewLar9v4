<?php

namespace App\View\Components\Navbar;

use Illuminate\View\Component;

class Link extends Component
{
    public $isForMobileMenu;
    public $isSelected;
    public $link;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($link, $isForMobileMenu = false, bool $isSelected = false)
    {
        $this->link             = $link;
        $this->isForMobileMenu  = $isForMobileMenu;
        $this->isSelected       = $isSelected;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.navbar.link');
    }
}
