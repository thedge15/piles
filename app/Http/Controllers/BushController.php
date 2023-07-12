<?php

namespace App\Http\Controllers;

use App\Http\Requests\Bush\BushStoreRequest;
use App\Http\Requests\Bush\ProjectStoreRequest;
use App\Http\Requests\Bush\ProjectUpdateRequest;
use App\Models\Bush;
use App\Models\Project;

class BushController extends Controller
{

    public function storeBush(BushStoreRequest $request)
    {
        $data = $request->validated();
        Bush::query()->create($data);
    }



    public function projectStore(ProjectStoreRequest $request)
    {
        $data = $request->validated();
        Project::query()->create($data);
    }

    public function destroy(Bush $bush)
    {
        collect($bush->projects)->each(function ($item) {
            $this->projectDestroy($item);
        });

        $bush->delete();
    }

    public function projectChangeUpdate(ProjectUpdateRequest $request, Project $project)
    {
        $data = $request->validated();
        $project->update($data);
    }

    public function projectDestroy(Project $project)
    {
        $project->materials()->delete();
        $project->elements()->delete();
        $project->delete();
    }
}
