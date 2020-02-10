<?php

namespace App\Observers;


use App\Entities\ProductCategory;
use Illuminate\Support\Facades\Auth;

class  ProductCategoryObserver
{
    public function creating(ProductCategory $productCategory)
    {
        $productCategory->created_by = Auth::id();
    }

    public function updating(ProductCategory $productCategory)
    {
        $productCategory->updated_by = Auth::id();
    }

    public function deleting(ProductCategory $productCategory)
    {
        $productCategory->deleated_by = Auth::id();
    }
}
