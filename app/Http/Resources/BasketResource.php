<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BasketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'discount_rate' => $this->discount_rate,
            'discounted_price' => $this->discounted_price,
            'total' => $this->total,
            'status' => $this->status ? 'Paid' : 'Unpaid',
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
