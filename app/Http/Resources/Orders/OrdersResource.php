<?php

namespace App\Http\Resources\Orders;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrdersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"             =>  $this->id,
            "user"           =>  $this->user,
            "total"          =>  $this->total,
            "paid"           =>  $this->paid,
            "payment_method" =>  $this->payment_method,
            "created_at"     =>  $this->created_at,
            "updated_at"     =>  $this->updated_at,
        ];
    }
}
