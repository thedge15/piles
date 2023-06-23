<?php

namespace App\Http\Resources\Pile;

use App\Http\Resources\Project\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Resources\Json\JsonResource;

class PileResource extends JsonResource
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
            'project' => new ProjectResource($this->project),
            'title' => $this->title,
            'tube' => $this->tube,
            'length' => $this->length,
            'altitude_mark' => $this->altitude_mark,
        ];
    }
}
