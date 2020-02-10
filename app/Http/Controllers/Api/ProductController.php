<?php


namespace App\Http\Controllers\Api;

use App\Entities\Product;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Request\ProductRequest;
use App\Http\Repositories\ProductRepository;
use App\Resources\Resource\ProductResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    protected $repository;

    public function __construct(Product $product)
    {
        $this->repository = new ProductRepository($product);
    }

    public function index()
    {
        return $this->repository->getAll();
    }

    public function show($id)
    {
        $product = $this->repository->getById($id);
        return new ProductResource($product);
    }

    public function store(ProductRequest $productRequest)
    {
        DB::beginTransaction();
        try {
            $attributes = $productRequest->only($this->repository->getModel()->getFillable());
            $this->repository->create($attributes);
            DB::commit();
            return response()
                ->json([
                    'message' => 'Product Created SuccessFully'
                ], Response::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage() . '' . $e->getTraceAsString());
            return \response()
                ->json([
                    'error' => 'Whoops Something Went Wrong !'
                ], $e->getCode());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $this->repository->delete($id);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            return \response()
                ->json([
                    'error' => 'Product Category Cannot be deleted !'
                ], $exception->getCode());
        }
    }
}
