<?php

namespace App\Http\Requests\Orders;

use Illuminate\Validation\Rule;
use App\Rules\CheckStockAvailabilityRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'products' => [
                'required',
                'array',
                'min:1',
                new CheckStockAvailabilityRule()
            ],
            'products.*' => [
                'product_id'   => ['required', 'integer', Rule::exists('products', 'id')->whereNull('deleted_at')->where('in_stock', '<=', 1)],
                'quantity'     => ['required', 'integer', 'min:1'],
            ]

        ];
    }
}
