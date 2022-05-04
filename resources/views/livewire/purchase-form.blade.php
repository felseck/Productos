<div>
    
<h1>Purchase form</h1>

<br><br>
<div>
                  
                                <label class="block text-sm font-medium mb-1" for="country">Products</label>
                                <select wire:model="product_id" class="form-select">

                                    @foreach($products as $key=>$product)
                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
                                </select>
                            </div>

<br>
<br><br>

                            <button wire:click="purchase" class="btn bg-emerald-500 hover:bg-emerald-600 text-white">Purchase Producto {{$product_id}}</button>
                          
<br><br>
{{$message}}
</div>
