<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Subscriptions extends Component
{
    public function render()
    {
        return view('livewire.subscriptions');
    }

    public function newSubscription($name, $price){
        auth()->user()->newSubscription($name, $price)->create();
    }

    public function changingPlans($name, $price){
        auth()->user()->subscription($name)->swap($price);
    }
}
