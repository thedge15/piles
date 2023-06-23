<?php

namespace App\Http\Resources\Tube;

use Illuminate\Http\Resources\Json\JsonResource;

class TubeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'diameter' => $this->diameter,
            'wall_thickness' => $this->wall_thickness,
            'change' => $this->change,
        ];
    }
}
