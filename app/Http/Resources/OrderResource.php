<?php

namespace App\Http\Resources;

use App\Http\Resources\Shop\ShopProductsResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'items_sum' => $this->items_sum,
            'delivery_sum' => $this->delivery_sum,
            'sum' => $this->total_sum,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user_id' => $this->user_id,
            'address' => $this->address,
            'comment' => $this->comment,
            'domain' => $this->domain,
            'items' => $this->whenLoaded('items', function () {
                return $this->items->map(function ($item) {
                    return [
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                        'product' => ShopProductsResource::make($item->product),
                    ];
                });
            }),
        ];
    }
}
