<?php

namespace App\Observers;


use App\Entities\BlogCategory;
use Illuminate\Support\Facades\Auth;

class  BlogCategoryObserver
{
    public function creating(BlogCategory $blogCategory)
    {
        $blogCategory->created_by = Auth::guard('api')->id();
    }
    public function updating(BlogCategory $blogCategory)
    {
        $blogCategory->updated_by = Auth::guard('api')->id();
    }
    public function deleting(BlogCategory $blogCategory)
    {
        $blogCategory->deleated_by = Auth::guard('api')->id();
    }
}
