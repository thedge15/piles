<?php

namespace App\Actions;

use App\Http\Resources\Characteristic\CharacteristicResource;
use App\Http\Resources\Element\ElementResource;
use App\Http\Resources\Material\MaterialResource;
use App\Http\Resources\Metal\MetalResource;
use App\Http\Resources\Paint\PaintResource;
use App\Http\Resources\Project\ProjectResource;
use App\Http\Resources\Standard\StandardResource;
use App\Http\Resources\Steel\SteelResource;
use App\Http\Resources\Unit\UnitResource;
use App\Models\Characteristic;
use App\Models\Metal;
use App\Models\Paint;
use App\Models\Project;
use App\Models\Standard;
use App\Models\Steel;
use App\Models\Unit;

class IndexMaterialsAction
{
    public function handle(Project $project): array
    {
        $elements = ElementResource::collection($project->elements->sortBy('title'))->resolve();
        $materials = MaterialResource::collection($project->materials)->resolve();
        $project = new ProjectResource($project);
        $metals = MetalResource::collection(Metal::all()->sortBy('title'))->resolve();
        $characteristics = CharacteristicResource::collection(Characteristic::all()->sortBy('title', SORT_NATURAL))->resolve();
        $standards = StandardResource::collection(Standard::all()->sortBy('title'))->resolve();
        $steels = SteelResource::collection(Steel::all()->sortBy('title'))->resolve();
        $units = UnitResource::collection(Unit::all()->sortBy('title'))->resolve();
        $paints = PaintResource::collection(Paint::all()->sortBy('title'))->resolve();

        return compact( [
            'materials', 'project', 'metals', 'characteristics', 'standards', 'units', 'steels', 'elements', 'paints']);
    }
}
