<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FoodResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'category' => $this->foodCategory->name,
            'price' => $this->price,
            $this->mergeWhen(!is_null($this->discount_id),
                [
                    'off' =>
                        [
                            'label' => optional($this->discount) ->value,
                            'factor' => (100 - optional($this->discount)->value)/100
                        ]
                ]
            ),
            $this->mergeWhen(!is_null($this->raw_material), ['raw material' => $this->raw_material]),
            'image' => 'http://127.0.0.1:8000/' . $this->image_path,
        ];
    }
}
