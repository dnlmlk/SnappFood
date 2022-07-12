<?php

namespace App\Http\Resources;

use App\Models\Address;
use App\Models\Restaurant;
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
            'address' => new AddressResource(Restaurant::find($this->id)->address),
            'status' => $this->status,

            'schedule' => new ScheduleResource(Schedule::where('id', $this->id)->first()),
        ];
    }
}
