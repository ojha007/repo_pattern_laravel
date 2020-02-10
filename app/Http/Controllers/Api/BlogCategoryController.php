<?php

namespace App\Http\Controllers\Api;

use App\Entities\BlogCategory;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Request\BlogCategoryRequest;
use App\Http\Repositories\BlogCategoryRepository;
use App\Http\Resources\Resource\BlogCategoryResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BlogCategoryController extends Controller
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new BlogCategoryRepository(new BlogCategory());
    }

    public function index()
    {
        $categories = $this->repository->paginate(20);
        return BlogCategoryResource::collection($categories);
    }

    public function show($id)
    {
        $blogCategory = $this->repository->getById($id);
        return new BlogCategoryResource($blogCategory);
    }

    public function store(BlogCategoryRequest $blogCategoryRequest)
    {

        DB::beginTransaction();
        try {
            $blogCategory = $this->repository->create($blogCategoryRequest->all());
            DB::commit();
            return new BlogCategoryResource($blogCategory);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }
    }


    public function update(BlogCategoryRequest $blogCategoryRequest, $id)
    {
        DB::beginTransaction();
        try {
            $blogCategory = $this->repository->update($id, $blogCategoryRequest->all());
            DB::commit();
            return new BlogCategoryResource($blogCategory);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }

    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return response()->json(['message' => 'deleted'], Response::HTTP_OK);
    }
}
