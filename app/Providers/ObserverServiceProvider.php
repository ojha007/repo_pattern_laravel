<?php

namespace App\Providers;

use App\Entities\Blog;
use App\Entities\BlogCategory;
use App\Entities\Product;
use App\Entities\ProductCategory;
use App\Observers\BlogCategoryObserver;
use App\Observers\BlogObserver;
use App\Observers\ProductCategoryObserver;
use App\Observers\ProductObserver;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{


    public function boot()
    {
        BlogCategory::observe(BlogCategoryObserver::class);
        Product::observe(ProductObserver::class);
        ProductCategory::observe(ProductCategoryObserver::class);
        Blog::observe(BlogObserver::class);
    }

    public function register()
    {

    }
}
