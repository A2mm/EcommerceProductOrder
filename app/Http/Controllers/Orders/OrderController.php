<?php

namespace App\Http\Controllers\Orders;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\Orders\OrderService;
use App\Http\Resources\Orders\OrdersResource;
use App\Http\Requests\Orders\CreateOrderRequest;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class OrderController extends Controller
{
    /**
     * @param OrderService $orderService
    **/

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(Request $request): JsonResponse
    {
        $response = OrdersResource::collection($this->orderService->setUser(auth()->user())->index(array_filter($request->all())));
        return $this->successResponse($response, HttpResponse::HTTP_OK, 'successful list');
    }

    public function show(int $id): JsonResponse
    {
        $response = new OrdersResource($this->orderService->setUser(auth()->user())->show($id));
        return $this->successResponse($response, HttpResponse::HTTP_OK, 'successful view');
    }

    public function create(CreateOrderRequest $request): JsonResponse
    {
        try{
            DB::beginTransaction();
            $this->orderService->setUser(auth()->user())->create($request->validated());
            DB::commit();
            return $this->successResponse([], HttpResponse::HTTP_CREATED, 'successful create');
        }catch(Exception $exception){
            DB::rollback();
            throw new Exception($exception->getMessage(),$exception->getCode());
        }
    }
}
