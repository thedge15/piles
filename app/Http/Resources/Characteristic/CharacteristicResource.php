<?php

namespace App\Http\Resources\Characteristic;

use App\Models\Metal;
use Illuminate\Http\Resources\Json\JsonResource;

class CharacteristicResource extends JsonResource
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
            'metal' => Metal::query()->find($this->metal_id)->title,
            'title' => $this->title,
            'ton_length' => $this->ton_length,
            'ton_area' => $this->ton_area,
        ];
    }
}
