<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pile\PileCalculateRequest;
use App\Http\Requests\Pile\PileStoreRequest;
use App\Http\Requests\Pile\PileUpdateRequest;
use App\Http\Resources\Pile\PileResource;
use App\Http\Resources\Project\ProjectResource;
use App\Http\Resources\Tube\TubeResource;
use App\Models\Pile;
use App\Models\Project;
use App\Models\Tube;

class PileController extends Controller
{

    public function store(PileStoreRequest $request)
    {
        $data = $request->validated();

        $quantity = $data['quantity'];
        unset($data['quantity']);

        for ($i = 1; $i < $quantity + 1; $i++) {
            Pile::query()->create($data);
        }
    }

    public function show(Project $project): \Inertia\Response|\Inertia\ResponseFactory
    {
        $concreteQuantity = 0;
        $piles = PileResource::collection(Pile::query()->where('project_id', $project->id)->get());
        $project = new ProjectResource($project);
        $tubes = TubeResource::collection(Tube::all());

        return inertia('Pile/Show', compact('piles', ['project', 'tubes', 'concreteQuantity']));
    }

    public function calculate(PileCalculateRequest $request): string
    {
        $data = $request->validated();

        $pilesMap = [];

        foreach ($data['checkedMaterials'] as $item) {
            $pile = Pile::query()->find($item)->toArray();
            $pilesMap[] = $this->preparePile($pile);
        }

        return 'Необходимо ' . round(array_sum($pilesMap), 2) . ' м3 бетона';
    }

    public function update(PileUpdateRequest $request, Pile $pile)
    {
        $data = $request->validated();
        $pile->update($data);
    }

    public function destroy(Pile $pile)
    {
        $pile->delete();
    }

    private function preparePile($pile): float|int
    {
        $projectId = $pile['project_id'];

        $pipe = $pile["tube"];

        $pipeSection = explode(' ',$pipe)[1];
        $processedPipeSection = explode('Х', $pipeSection);
        $innerDiameter = ((int)$processedPipeSection[0] - (int)$processedPipeSection[1] * 2) / 1000;
        $cylinderBase = M_PI * pow($innerDiameter, 2) / 4;

        $desiredHeightPipe = ($this->getFreezingMark($projectId) + $pile["altitude_mark"]) / 1000;

        return $desiredHeightPipe * $cylinderBase;
    }

    private function getFreezingMark($projectId): int
    {
        $freezingMarksMap = [
            1 => 4500,
            2 => 4000,
            3 => 4000,
            4 => 4000,
            5 => 4000,
            6 => 4000,
            7 => 3000,
            8 => 4000,
        ];

        return $freezingMarksMap[$projectId];
    }

}
