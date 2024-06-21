<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $names = array_filter([$this->first_name, $this->last_name], function ($value){
            return $value !== null && $value !== '';
        });
        $full_name = implode(' ', $names);

        $data = [
            'id' => $this->id,
            'email' => $this->email,
            'role' => $this->role,
            'phone' => $this->phone,
            'customer_id' => $this->customer_id,
            'full_name' => $full_name,
        ];

        return $data;
    }
}
