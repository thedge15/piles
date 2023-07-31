<?php

namespace App\Actions;

use App\Http\Resources\Bush\BushResource;
use App\Http\Resources\Project\ProjectResource;
use App\Models\Bush;

class IndexProjectsAction
{
    public function handle(Bush $bush): array
    {
        $projects = ProjectResource::collection($bush->projects)->resolve();
        $bush = new BushResource($bush);
        return compact('projects', 'bush');
    }
}
