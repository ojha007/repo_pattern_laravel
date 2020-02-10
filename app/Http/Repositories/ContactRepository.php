<?php

namespace App\Http\Repositories;


use App\Http\Repositories\Contrasts\Repository;


class  ContactRepository extends Repository
{
    protected $model;

    public function __construct(Role $model)
    {
        $this->model = $model;
    }


}
