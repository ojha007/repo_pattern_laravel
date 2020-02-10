<?php

namespace App\Http\Repositories;


use App\Entities\Blog;
use App\Http\Repositories\Contrasts\Repository;

class  BlogRepository extends Repository
{
    protected $model;

    public function __construct(Blog $model)
    {
        $this->model = $model;
    }


}
