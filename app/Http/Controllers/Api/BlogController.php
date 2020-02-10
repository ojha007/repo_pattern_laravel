<?php

namespace App\Http\Controllers\Api;

use App\Entities\Blog;
use App\Http\Resources\Resource\BlogResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Request\BlogRequest;
use App\Http\Repositories\BlogRepository;
use App\Http\Resources\Collection\BlogCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new BlogRepository(new Blog());
    }

    public function index()
    {
        $results = $this->repository->paginate(20);
        return new BlogCollection(BlogResource::collection($results));
    }

    public function show($id)
    {
        $blog = $this->repository->getById($id);
        return new BlogResource($blog);
    }

    public function store(BlogRequest $blogRequest)
    {

        DB::beginTransaction();
        try {
            $blog = $this->repository->create($blogRequest->all());
            $blog->setStatus('pending');
            DB::commit();
            return new BlogResource($blog);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }
    }


    public function update(BlogRequest $blogRequest, $id)
    {
        DB::beginTransaction();
        try {
            $blog = $this->repository->update($id, $blogRequest->all());
            DB::commit();
            return new BlogResource($blog);
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

    public function changeStatus($id)
    {

        $blog = $this->repository->changeStatusTo($id, 'approved');
        return new BlogResource($blog);
    }
}
