<?php

namespace App\Http\Repositories;


use App\Entities\Product;
use App\Http\Repositories\Contrasts\Repository;

class  ProductRepository extends Repository
{
    protected $model;

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

}
