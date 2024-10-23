<?php

namespace App\Services\Products;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Products\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService
{
    public function index($data): LengthAwarePaginator
    {
        $cacheKey = 'products_' . implode('_', $data);
        $products = Cache::remember($cacheKey, 60, function () use ($data){
            return $this->applyFilters($data);
        });
        return $products;
    }

    private function applyFilters(array $data): LengthAwarePaginator
    {
        $query = Product::query()

        ->when($data['category_id'] ?? null, function (Builder $query, $value) {
            $query->where('category_id', $value);
        })
        ->when($data['price_from'] ?? null, function (Builder $query, $value) {
                $query->where('price', '>=', $value);
            })
            ->when($data['price_to'] ?? null, function (Builder $query, $value) {
                $query->where('price', '<=', $value);
            })
            ->when($data['search'] ?? null, function (Builder $query, $value) {
                $query->where(function ($query) use ($value) {
                    $query->where('name', 'LIKE', '%'.$value.'%');
                });
            });

        return $query->with('category:id,name')->paginate(defaultPaginationSize());
    }

    public function show(int $id): ?Product
    {
        return $this->findById($id);
    }

    public function create($data): bool
    {
        Product::create($data);
        return true;
    }

    public function update(int $id, $data): bool
    {
        $product = $this->findById($id);
        return $product->update($data);
    }

    public function delete(int $id): bool
    {
        $product = $this->findById($id);
        return $product->delete();
    }

    public function findById(int $id): Product
    {
        return Product::with('category:id,name')->findOrFail($id);
    }
}
