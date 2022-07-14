<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public $count = 0;
    public $text = 'aaa';
 
    public function increment()
    {
        $this->count++;
    }

    public function write($value)
    {
        $this->text = $value;
    }

    public function render()
    {
        return view('livewire.counter');
    }
}
