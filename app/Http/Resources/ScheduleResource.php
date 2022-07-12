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
                'from' => optional($this->saturday)[0],
                'to' => optional($this->saturday)[1],
                ],
            'sunday' => [
                'from' => optional($this->sunday)[0],
                'to' => optional($this->sunday)[1],
            ],
            'monday' => [
                'from' => optional($this->monday)[0],
                'to' => optional($this->monday)[1],
            ],
            'tuesday' => [
                'from' => optional($this->tuesday)[0],
                'to' => optional($this->tuesday)[1],
            ],
            'wednesday' => [
                'from' => optional($this->wednesday)[0],
                'to' => optional($this->wednesday)[1],
            ],
            'thursday' => [
                'from' => optional($this->thursday)[0],
                'to' => optional($this->thursday)[1],
            ],
            'friday' => [
                'from' => optional($this->friday)[0],
                'to' => optional($this->friday)[1],
            ],

        ];
    }
}
