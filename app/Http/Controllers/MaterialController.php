<?php

namespace App\Http\Controllers;

use App\Http\Requests\Material\MaterialStoreRequest;
use App\Http\Requests\Material\MaterialUpdateRequest;
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
use App\Models\StandardType;
use App\Models\Steel;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;


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
        $paints = PaintResource::collection(Paint::all())->resolve();
        $materials = MaterialResource::collection($project->materials)->resolve();
        $project = new ProjectResource($project);
        $metals = MetalResource::collection(Metal::all())->resolve();
        $characteristics = CharacteristicResource::collection(Characteristic::all())->resolve();
        $standards = StandardResource::collection(Standard::all())->resolve();
        $steels = SteelResource::collection(Steel::all())->resolve();
        $units = UnitResource::collection(Unit::all())->resolve();
        $elements = ElementResource::collection($project->elements)->resolve();

        return inertia('Material/Index', compact('materials', [
            'materials',
            'project',
            'metals',
            'characteristics',
            'standards',
            'units',
            'steels',
            'elements',
            'paints'
        ]));
    }

    public function storeMaterials(MaterialStoreRequest $request)
    {

        /** @var TYPE_NAME $weight */
        /** @var TYPE_NAME $length */
        /** @var TYPE_NAME $thickness */

        $data = $request->validated();


        $data['metal_id'] = DB::table('metals')->where('title', $data['metal'])->first()->id;


        if ($data['sheetHeight'] && $data['sheetWidth']) {
            $thickness = $data['title'];
            $data['title'] = $data['title'] . 'X' . $data['sheetHeight'] . 'X' . $data['sheetWidth'];
        }


        if ($data['metal'] !== 'Лист') {

            $tonLength = DB::table('characteristics')->where('title', $data['title'])->first()->ton_length;
            $tonArea = DB::table('characteristics')->where('title', $data['title'])->first()->ton_area;

            if ($data['measure_units'] === 'т') {
                $data['weight'] = $data['quantity'];
                $data['length'] = $data['weight'] * $tonLength;
            } elseif ($data['measure_units'] === 'м') {
                $data['length'] = $data['quantity'];
                $data['weight'] = $data['length'] / (float)$tonLength;
            } elseif ($data['measure_units'] === 'шт.' && $data['metalLength']) {
                $data['length'] = $data['metalLength'] * $data['quantity'] / 1000;
                $data['weight'] = $data['length'] / (float)$tonLength;
            }

            $data['area'] = $data['weight'] * $tonArea;

        } else {
            if ($data['measure_units'] === 'т') {
                $tonArea = DB::table('characteristics')->where('title', $data['title'])->first()->ton_area;
                $data['weight'] = $data['quantity'];
                $data['area'] = $tonArea * $data['weight'];
            } elseif ($data['measure_units'] === 'шт.') {
                $tonArea = DB::table('characteristics')->where('title', $thickness)->first()->ton_area;
                $data['area'] = 2 * ($data['sheetHeight'] / 1000) * ($data['sheetWidth'] / 1000) * $data['quantity'];
                $data['weight'] = $data['area'] / $tonArea;
            }
        }


        if ($data['metalLength']) {
            $data['title'] = $data['title'] . ' L=' . $data['metalLength'];
        }
        $data['title'] = $data['metal'] . ' ' . $data['title'] . ' ' . $data['standard'] . ' ' . $data['steel'];

        unset($data['metal']);
        unset($data['standard']);

        if ($data['measure_units'] !== 'шт.') {
            unset($data['quantity']);
        }

        unset($data['measure_units']);
        unset($data['steel']);
        unset($data['sheetHeight']);
        unset($data['sheetWidth']);
        unset($data['metalLength']);

//        dd($data);

        Material::query()->create($data);
    }

    public function updateMaterial(MaterialUpdateRequest $request, Material $material)
    {
        $data = $request->validated();

        $paint = Paint::query()->where('title', $data['paint'])->get()->toArray();

        if ($data['paint'] && $data['numberOfLayers']) {
            $data['paint_quantity'] = $paint[0]['consumption'] * $data['numberOfLayers'] * $data['area'];
        } else if (!$data['paint'] && !$data['numberOfLayers']) {
            unset($data['paint']);
            unset($data['numberOfLayers']);
        }


        unset($data['numberOfLayers']);
        $material->update($data);
    }

    public function deleteMaterial(Material $material)
    {
        $material->delete();
    }

    public
    function showAll(): \Inertia\Response|\Inertia\ResponseFactory
    {
        $materials = Material::all();

        $bushes = Bush::all();
        $characteristics = Characteristic::all();
        $projects = Project::all();
        $metals = Metal::all();
        $standards = Standard::all();
        $standardTypes = StandardType::all();
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
                    'standardTypes',
                    'steels',
                    'units',
                    'elements',
                    'paints',
                ]
            )
        );
    }
}

