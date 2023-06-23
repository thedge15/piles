<?php

namespace App\Http\Resources\Paint;

use Illuminate\Http\Resources\Json\JsonResource;

class PaintResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array|\JsonSerializable|\Illuminate\Contracts\Support\Arrayable
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'consumption' => $this->consumption,
            'color' => $this->color,
        ];
    }
}
