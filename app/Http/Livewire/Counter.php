<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public $count = 0;
    public $errorMessage = '';
    public $text = 'aaa';
 
    public function increment()
    {
        $this->count++;
    }

    public function decrease()
    {
        if($this->count > 0) {
            $this->count--;
        } else {
            $this->errorMessage = 'Has llegado a 0';
        }
    }
    
    public function hydrateCount()
    {
        if($this->count >= 0 && $this->errorMessage !== '') {
            $this->errorMessage = '';
        }
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
