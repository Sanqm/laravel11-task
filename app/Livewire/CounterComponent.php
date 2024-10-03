<?php

namespace App\Livewire;

use Livewire\Component;

class CounterComponent extends Component
{
    public $count = "cagarro como un carro";
    public function render()
    {
        return view('livewire.counter-component');
    }
}
