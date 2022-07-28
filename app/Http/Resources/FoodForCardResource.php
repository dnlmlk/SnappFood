<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use phpDocumentor\Reflection\Types\This;

class FoodForCardResource extends JsonResource
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

                'Id' => $this->id,
                'Title' => $this->name,
                'Price' => $this->final_price,
                'Count' => $this->getOriginal()['pivot_count']
            ];
    }
}
