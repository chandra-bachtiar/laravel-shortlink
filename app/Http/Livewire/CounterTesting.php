<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CounterTesting extends Component
{
    public $count = 0;
 
    public function increment()
    {
        $this->count++;
    }
 
    public function render()
    {
        return view('livewire.counter-testing');
    }
}
