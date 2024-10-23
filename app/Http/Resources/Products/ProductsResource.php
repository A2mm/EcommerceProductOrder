<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"            =>  $this->id,
            "name"          =>  $this->name,
            "description"   =>  $this->description,
            "thumbnail"     =>  $this->thumbnail,
            "price"         =>  $this->price,
            "in_stock"      =>  $this->in_stock,
            "category"      =>  $this->category,
            "created_at"    =>  $this->created_at,
            "updated_at"    =>  $this->updated_at,
        ];
    }
}
