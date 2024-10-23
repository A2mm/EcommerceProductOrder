<?php

namespace App\Http\Controllers\Products;

use Exception;
use Illuminate\Http\Request;
use App\Models\Products\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\Products\ProductService;
use App\Http\Resources\Products\ProductsResource;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use App\Http\Requests\Products\{CreateProductRequest, UpdateProductRequest};

class ProductController extends Controller
{
    /**
     * @param ProductService $productService
    **/

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request): JsonResponse
    {
        $response = ProductsResource::collection($this->productService->index(array_filter($request->all())));
        return $this->successResponse($response, HttpResponse::HTTP_OK, 'successful list');
    }

    public function show(int $id): JsonResponse
    {
        $response = new ProductsResource($this->productService->show($id));
        return $this->successResponse($response, HttpResponse::HTTP_OK, 'successful view');
    }

    public function create(CreateProductRequest $request): JsonResponse
    {
        try{
            DB::beginTransaction();
            $this->productService->create($request->validated());
            DB::commit();
            return $this->successResponse([], HttpResponse::HTTP_CREATED, 'successful create');
        }catch(Exception $exception){
            DB::rollback();
            throw new Exception($exception->getMessage(),$exception->getCode());
        }
    }

    public function update(int $id, UpdateProductRequest $request): JsonResponse
    {
        try{
            DB::beginTransaction();
            $this->productService->update($id, $request->validated());
            DB::commit();
            return $this->successResponse([], HttpResponse::HTTP_ACCEPTED, 'successful update');
        }catch(Exception $exception){
            DB::rollback();
            throw new Exception($exception->getMessage(),$exception->getCode());
        }
    }

    public function delete(int $id): JsonResponse
    {
        $this->productService->delete($id);
        return $this->successResponse([], HttpResponse::HTTP_OK, 'successful delete');
    }
}
