<?php

namespace App\Rules;

use Closure;
use App\Models\Products\Product;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckStockAvailabilityRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        foreach ($value as $item) {

            $product = Product::find($item['product_id']);

            if ($product->in_stock < $item['quantity']) {
                $fail("Not enough stock for Product ID {$item['product_id']}. Available: {$product->in_stock}, Requested: {$item['quantity']}");
            }
        }
    }
}
