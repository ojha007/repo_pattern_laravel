<?php

namespace App\Http\Repositories;


use App\Entities\ProductCategory;
use App\Http\Repositories\Contrasts\Repository;

class  ProductCategoryRepository extends Repository
{

    protected $model;

    public function __construct(ProductCategory $productCategory)
    {
        $this->model = $productCategory;
    }

    public function getAllParentIdWhereNull()
    {
        return $this->model->whereNull('product_category_id');

    }

    public function getHierarchical()
    {
        return $this->model->with('childCategoryRecursive')->whereNull('product_category_id')->get();
    }

}
