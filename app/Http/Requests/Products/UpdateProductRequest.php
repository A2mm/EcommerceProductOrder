<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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

            'name'         => ['required', 'string', 'min:3', Rule::unique('products', 'name')->ignore($this->id)->whereNull('deleted_at')],
            'description'  => ['nullable', 'string'],
            'thumbnail'    => ['nullable', 'string'],
            'price'        => ['required', 'numeric', 'min:1'],
            'in_stock'     => ['required', 'integer', 'min:1'],

        ];
    }
}
