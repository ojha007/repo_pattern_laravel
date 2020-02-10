<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Request\PermissionRequest;
use App\Http\Repositories\PermissionRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new PermissionRepository(new Permission());
    }

    public function index()
    {
        $results = $this->repository->paginate(20);
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

    public function store(PermissionRequest $permissionRequest)
    {
        DB::beginTransaction();
        try {
            $attributes = $permissionRequest->only('name', 'guard_name');
            $result = $this->repository->create($attributes);
            $result->assignRole($permissionRequest->get('role_name'));
            DB::commit();
            return \response()->json([
                'data' => $result
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage() . '' . $e->getTraceAsString());
        }
        return false;
    }


    public function update(PermissionRequest $permissionRequest, $id)
    {
        DB::beginTransaction();
        try {
            $result = $this->repository->update($id,
                $permissionRequest->only('name', 'guard_name')
            );
            $result->assignRole($permissionRequest->get('role_name'));
            DB::commit();
            return \response()->json([
                'data' => $result->with('role')
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
