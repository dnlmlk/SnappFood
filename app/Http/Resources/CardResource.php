<?php

namespace App\Http\Resources;

use App\Models\Food;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class CardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'Card ID' => $this->id,
            'Status' => $this->customer_status,
            'Restaurant' => [
                'Title' => Restaurant::find($this->restaurant_id)->name,
                'Category' => Restaurant::find($this->restaurant_id)->restaurantCategory->name
            ],
            'Foods' => FoodForCardResource::collection($this->foods),
        ];
    }
}
