<?php

namespace App\Http\Repositories;


use App\Http\Repositories\Contrasts\Repository;
use Spatie\Permission\Models\Permission;

class  PermissionRepository extends Repository
{
    protected $model;

    public function __construct(Permission $model)
    {
        $this->model = $model;
    }


}
