<?php

namespace App\Http\Controllers;

use App\Http\Requests\Bush\BushStoreRequest;
use App\Http\Requests\Bush\ImageStoreRequest;
use App\Http\Requests\Bush\ProjectStoreRequest;
use App\Http\Requests\Bush\ProjectUpdateRequest;
use App\Http\Resources\Bush\BushResource;
use App\Http\Resources\Project\ProjectResource;
use App\Models\Bush;
use App\Models\Project;

class BushController extends Controller
{
    public function index(): \Inertia\Response|\Inertia\ResponseFactory
    {
        $bushes = BushResource::collection(Bush::all());
        return inertia('Bush/Index', compact('bushes'));
    }

    public function store(BushStoreRequest $request)
    {
        $data = $request->validated();
        Bush::query()->create($data);
    }

    public function show(Bush $bush): \Inertia\Response|\Inertia\ResponseFactory
    {
        $projects = Project::query()->where('bush_id', $bush->id)->get();

        $projects = ProjectResource::collection($projects);
        $bush = new BushResource($bush);
        return inertia('Bush/Show', compact('projects', 'bush'));
    }

    public function projectStore(ProjectStoreRequest $request)
    {
        $data = $request->validated();
        Project::query()->create($data);
    }

    public function destroy(Bush $bush)
    {
        $bush->delete();
    }

    public function projectChangeUpdate(ProjectUpdateRequest $request, Project $project)
    {
        $data = $request->validated();
        $project->update($data);
    }

    public function projectDestroy(Project $project)
    {
        $piles = $project->piles();
        $piles->delete();
        $project->delete();
    }
}
