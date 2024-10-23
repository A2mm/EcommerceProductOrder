<?php

namespace App\Services\Orders;

use App\Traits\HasUser;
use App\Models\Orders\Order;
use App\Events\OrderPlacedEvent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Services\Products\UpdateQuantityService;

class OrderService
{
    use HasUser;

     /**
     * @param UpdateQuantityService $updateQuantityService
    **/

    public function __construct(UpdateQuantityService $updateQuantityService)
    {
        $this->updateQuantityService = $updateQuantityService;
    }

    public function index($data): LengthAwarePaginator
    {
        return $this->applyFilters($data);
    }

    private function applyFilters(array $data): LengthAwarePaginator
    {
        return $this->fetchQuery()->paginate(defaultPaginationSize());
    }

    public function show(int $id)
    {
        return $this->findById($id);
    }

    public function create(array $data): bool
    {
        $orderData = $this->orderData();
        $order     = $this->user->orders()->create($orderData);
        $order->products()->sync($data['products']);
        $this->updateQuantityService->decreaseProductsQuantity($data['products']);
        event(new OrderPlacedEvent($order));
        return true;
    }

    private function findById(int $id): ?Order
    {
        return $this->fetchQuery()->findOrFail($id);
    }

    private function fetchQuery()
    {
        return Order::with('products', 'user:id,name');
    }

    private function orderData()
    {
        return [
            'total'          => '100', // will be sum of ordered products' prices
            'paid'           => 1,
            'payment_method' => 'cod',
        ];
    }
}
