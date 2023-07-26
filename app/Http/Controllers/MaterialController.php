<?php

namespace App\Http\Controllers;

use App\Actions\StoreMaterialAction;
use App\Actions\UpdateMaterialAction;
use App\Exports\MaterialsExport;
use App\Http\Resources\Bush\BushResource;
use App\Http\Resources\Characteristic\CharacteristicResource;
use App\Http\Resources\Element\ElementResource;
use App\Http\Resources\Material\MaterialResource;
use App\Http\Resources\Metal\MetalResource;
use App\Http\Resources\Paint\PaintResource;
use App\Http\Resources\Project\ProjectResource;
use App\Http\Resources\Standard\StandardResource;
use App\Http\Resources\Steel\SteelResource;
use App\Http\Resources\Unit\UnitResource;
use App\Models\Bush;
use App\Models\Characteristic;
use App\Models\Element;
use App\Models\Material;
use App\Models\Metal;
use App\Models\Paint;
use App\Models\Project;
use App\Models\Standard;
use App\Models\Steel;
use App\Models\Unit;
use Maatwebsite\Excel\Facades\Excel;


class MaterialController extends Controller
{
    public function index(Bush $bush): \Inertia\Response|\Inertia\ResponseFactory
    {
        $projects = ProjectResource::collection($bush->projects)->resolve();
        $bush = new BushResource($bush);
        return inertia('User/Index', compact('projects', 'bush'));
    }

    public function materials(Project $project): \Inertia\Response|\Inertia\ResponseFactory
    {
        $elements = ElementResource::collection(resource: $project->elements->sortBy('title'))->resolve();
        $materials = MaterialResource::collection($project->materials)->resolve();
        $project = new ProjectResource($project);
        $metals = MetalResource::collection(Metal::all()->sortBy('title'))->resolve();
        $characteristics = CharacteristicResource::collection(Characteristic::all()->sortBy('title', SORT_NATURAL))->resolve();
        $standards = StandardResource::collection(Standard::all()->sortBy('title'))->resolve();
        $steels = SteelResource::collection(Steel::all()->sortBy('title'))->resolve();
        $units = UnitResource::collection(Unit::all()->sortBy('title'))->resolve();
        $paints = PaintResource::collection(Paint::all()->sortBy('title'))->resolve();

        return inertia('Material/Index', compact('materials', [
            'materials', 'project', 'metals', 'characteristics', 'standards', 'units', 'steels', 'elements', 'paints']));
    }

    public function storeMaterials(StoreMaterialAction $action)
    {
        Material::query()->create($action->handle());
    }

    public function updateMaterial(UpdateMaterialAction $action)
    {
        Material::query()->update($action->handle());
    }

    public function deleteMaterial(Material $material)
    {
        $material->delete();
    }

    public function showAll(): \Inertia\Response|\Inertia\ResponseFactory
    {
        $materials = Material::all();
        $bushes = Bush::all();
        $characteristics = Characteristic::all();
        $projects = Project::all();
        $metals = Metal::all();
        $standards = Standard::all();
        $steels = Steel::all();
        $units = Unit::all();
        $elements = Element::all();
        $paints = Paint::all();

        return inertia('Material/All',
            compact(
                [
                    'materials',
                    'bushes',
                    'characteristics',
                    'metals',
                    'projects',
                    'standards',
                    'steels',
                    'units',
                    'elements',
                    'paints',
                ]
            )
        );
    }

    public function export(Project $project): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new MaterialsExport($project), 'materials.xlsx');
    }
}

