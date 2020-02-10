<?php

namespace App\Http\Controllers\Api;


use App\Entities\ProductCategory;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Request\ProductCategoryRequest;
use App\Http\Repositories\ProductCategoryRepository;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductCategoryController extends Controller
{
    protected $model, $repository;

    public function __construct(ProductCategory $productCategory)
    {
//        $this->middleware('can:product-category-view', ['only' => ['index']]);
        $this->repository = new ProductCategoryRepository($productCategory);
    }

    public function index()
    {
        return $this->repository->getHierarchical();
    }

    public function show($id)
    {
        return $this->repository->getByIdWithRelationShipArray($id, ['isParentCategory']);
    }

    public function store(ProductCategoryRequest $productCategoryRequest)
    {
        DB::beginTransaction();
        try {
            $attributes = $productCategoryRequest->only($this->repository->getModel()->getFillable());
            $this->repository->create($attributes);
            DB::commit();
            return response()
                ->json([
                    'message' => 'Product Category Created SuccessFully',
                ], Response::HTTP_OK);
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage() . '' . $exception->getTraceAsString());
            return response()
                ->json([
                    'error' => 'Whoops Something Went Wrong !'
                ], $exception->getCode());
        }

    }

    public function update(ProductCategoryRequest $productCategoryRequest, $id)
    {
        DB::beginTransaction();
        try {
            $attributes = $productCategoryRequest->only($this->repository->getModel()->getFillable());
            $this->repository->update($id, $attributes);
            DB::commit();
            return \response()
                ->json([
                    'message' => 'Product Category Updated SuccessFully'
                ], Response::HTTP_OK);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage() . '' . $e->getCode());
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
            return \response()
                ->json([
                    'message' => 'Product Category deleted SuccessFully!'
                ], Response::HTTP_OK);
        } catch (Exception $exception) {
            DB::rollBack();;
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            return \response()
                ->json([
                    'error' => 'Product Category Cannot be deleted !'
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


}
