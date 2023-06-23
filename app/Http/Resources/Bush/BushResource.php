<?php

namespace App\Http\Resources\Bush;

use App\Http\Resources\Project\ProjectResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BushResource extends JsonResource
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
        ];
    }
}
