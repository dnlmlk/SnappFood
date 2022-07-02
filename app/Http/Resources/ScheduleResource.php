<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
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
            'saturday' => [
                'from' => $this->saturday[0],
                'to' => $this->saturday[1],
                ],
            'sunday' => [
                'from' => $this->sunday[0],
                'to' => $this->sunday[1],
            ],
            'monday' => [
                'from' => $this->monday[0],
                'to' => $this->monday[1],
            ],
            'tuesday' => [
                'from' => $this->tuesday[0],
                'to' => $this->tuesday[1],
            ],
            'wednesday' => [
                'from' => $this->wednesday[0],
                'to' => $this->wednesday[1],
            ],
            'thursday' => [
                'from' => $this->thursday[0],
                'to' => $this->thursday[1],
            ],
            'friday' => [
                'from' => $this->friday[0],
                'to' => $this->friday[1],
            ],

        ];
    }
}
