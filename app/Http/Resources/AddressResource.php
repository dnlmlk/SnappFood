<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'Title' => $this->title,
            'Address' => $this->address,
            'Latitude' => $this->latitude,
            'Longitude' => $this->longitude,
            $this->mergeWhen($this->active == '1', ['is_Active' => 'Active']),
        ];
    }
}
