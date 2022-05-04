<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Purchase;

class PurchaseForm extends Component
{

    public $product_id = 1;
    public $message;

    public function render()
    {   
        $products = Product::all();

        return view('livewire.purchase-form',['products'=>$products]);
    }

    public function updating(){
        $this->message = '';
    }

    public function purchase()
    {   
       

        $purchase = new purchase;

        $product = Product::where(['id'=>$this->product_id])->first();

        $user = auth()->user();
        
        $purchase->product_name = $product->name;
        $purchase->price = $product->price;
        $purchase->tax = $product->tax;
        $purchase->user_id = $user->id;
        $purchase->product_id = $this->product_id;

        $purchase->save();

        $this->message = 'Success purchase';

    }

}
