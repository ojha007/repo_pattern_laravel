<?php

namespace App\Observers;


use App\Entities\Product;
use Illuminate\Support\Facades\Auth;

class  ProductObserver
{
    public function creating(Product $product)
    {
        $product->created_by = Auth::id();
    }

    public function updating(Product $product)
    {
        $product->update_by = Auth::id();
    }

    public function deleting(Product $product)
    {
        $product->deleated_by = Auth::id();
    }
}
