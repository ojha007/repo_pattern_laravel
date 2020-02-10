<?php

namespace App\Observers;


use App\Entities\Blog;
use Illuminate\Support\Facades\Auth;

class  BlogObserver
{
    public function creating(Blog $blog)
    {
        $blog->created_by = Auth::guard('api')->id();
    }

    public function updating(Blog $blog)
    {
        $blog->update_by = Auth::guard('api')->id();
    }

    public function deleting(Blog $blog)
    {
        $blog->deleated_by = Auth::guard('api')->id();
    }
}
