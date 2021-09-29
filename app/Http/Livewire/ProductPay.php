<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Exception;
use Livewire\Component;

class ProductPay extends Component
{
    public $product;

    protected $listeners = ['paymentMethodCreate'];

    public function mount(Product $product){
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.product-pay');
    }

    public function paymentMethodCreate($paymentMethod){
        try{
            auth()->user()->charge($this->product->price * 100, $paymentMethod);
            $this->emit('resetStripe');
        }catch (Exception $e){
            $this->emit('errorPayment');
        }
    }
}