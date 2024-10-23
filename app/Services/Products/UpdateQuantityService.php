<?php

namespace App\Services\Products;

use App\Models\Products\Product;
use Illuminate\Support\Facades\Cache;
use App\Services\Products\ProductService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class UpdateQuantityService
{
    /**
     * @param ProductService $productService
    **/

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function decreaseProductsQuantity(array $products): bool
    {
        foreach($products as $product)
        {
            $model = $this->productService->findById($product['product_id']);
            $model->update(['in_stock' => $model->in_stock - $product['quantity']]);
        }
        return true;
    }
}
