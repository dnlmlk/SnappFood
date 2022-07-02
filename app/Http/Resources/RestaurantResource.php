<?php

namespace App\Http\Resources;

use App\Models\Schedule;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantResource extends JsonResource
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
            'category' => $this->restaurantCategory->name,
            'phone' => $this->phone_number,
            'address' =>[
                'latitude' => explode(',', $this->address)[0],
                'longitude' => explode(',', $this->address)[1],
                ],
            'status' => $this->status,

            'schedule' => new ScheduleResource(Schedule::where('id', $this->id)->first()),
        ];
    }
}
