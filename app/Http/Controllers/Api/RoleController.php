<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Request\RoleRequest;
use App\Http\Repositories\RoleRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new RoleRepository(new Role());
    }

    public function index()
    {
        $results = $this->repository->getAll();
        return \response()->json([
            'data' => $results
        ], Response::HTTP_OK);
    }

    public function show($id)
    {
        $result = $this->repository->getById($id);
        return \response()->json([
            'data' => $result
        ], Response::HTTP_OK);
    }

    public function store(RoleRequest $roleRequest)
    {
        DB::beginTransaction();
        try {
            $attributes = $roleRequest->only('name', 'guard_name');
            $role = $this->repository->create($attributes);
            $role->givePermissionTo($roleRequest->get('permissions'));
            DB::commit();
            return \response()->json([
                'data' => $role,
                'message' => 'SuccessFully Added Role'
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage() . '' . $e->getTraceAsString());
            return \response()->json([
               'error'=>$e->getMessage(),
            ],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function update(RoleRequest $roleRequest, $id)
    {
        DB::beginTransaction();
        try {
            $this->repository->update($id, $roleRequest->all());
            DB::commit();
            return \response()->json([
                'data' => $this->repository->getWithRelation($id, 'permissions'),
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage() . '' . $e->getTraceAsString());
        }
        return false;
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return response()->json([
            'message' => 'deleted'
        ], Response::HTTP_OK);
    }
}
