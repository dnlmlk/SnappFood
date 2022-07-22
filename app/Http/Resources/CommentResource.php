<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'Comments' => [
                'Cart Id' => $this->order->id,
                'Author' => auth()->user()->name,
                'Food' => $this->food->name,
                'Score' => $this->score,
                'Content' => $this->message,
                $this->mergeWhen(!is_null($this->answer), ['Answer' => $this->answer]),
            ]
        ];
    }
}
