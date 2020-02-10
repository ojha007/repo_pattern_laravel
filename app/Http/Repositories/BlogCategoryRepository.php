<?php

namespace App\Http\Repositories;


use App\Entities\BlogCategory;
use App\Http\Repositories\Contrasts\Repository;

class  BlogCategoryRepository extends Repository
{
    protected $model;

    public function __construct(BlogCategory $model)
    {
        $this->model = $model;
    }



}
