<?php

namespace App\Http\Repositories;


use App\Http\Repositories\Contrasts\Repository;
use Spatie\Permission\Models\Role;

class  RoleRepository extends Repository
{
    protected $model;

    public function __construct(Role $model)
    {
        $this->model = $model;
    }




}
