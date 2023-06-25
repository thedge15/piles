<?php

namespace App\Http\Controllers;

use App\Http\Requests\Characteristic\CharacteristicStoreRequest;
use App\Http\Requests\Characteristic\CharacteristicUpdateRequest;
use App\Http\Requests\Metal\StoreMetalRequest;
use App\Http\Requests\Standard\StandardStoreRequest;
use App\Http\Requests\Steel\SteelStoreRequest;
use App\Http\Requests\Unit\UnitStoreRequest;
use App\Http\Resources\Characteristic\CharacteristicResource;
use App\Http\Resources\Metal\MetalResource;
use App\Http\Resources\Standard\StandardResource;
use App\Http\Resources\Steel\SteelResource;
use App\Http\Resources\Unit\UnitResource;
use App\Models\Characteristic;
use App\Models\Metal;
use App\Models\Standard;
use App\Models\Steel;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;

class SpecificationController extends Controller
{
    public function metal(): \Inertia\Response|\Inertia\ResponseFactory
    {
        $metals = MetalResource::collection(Metal::all());
        return inertia('Metal/Index', compact('metals'));
    }
    public function storeMetal(StoreMetalRequest $request)
    {
        $data = $request->validated();
        Metal::query()->create($data);
    }

    public function showMetal(Metal $metal): \Inertia\Response|\Inertia\ResponseFactory
    {
        $metals = DB::table('characteristics')->where('metal_id', $metal->id)->orderBy('title')->get();

        $metals = CharacteristicResource::collection($metals);
        $metal = new MetalResource($metal);

        return inertia('Metal/Show', compact('metals', 'metal'));
    }

    public function storeCharacteristic(CharacteristicStoreRequest $request)
    {
        $data = $request->validated();
        $metal = Metal::query()->find($data['metal_id'])->title;

//      для швеллера
        if ($metal === 'Швеллер' || $metal === 'Двутавр' || $metal === 'Лист просечно-вытяжной' || $metal === 'Профлист') {
            $data['title'] = $data['mark'];
        };

//      для уголка
        if ($metal === 'Уголок') {
            $data['title'] = is_null($data["second_size"]) ? $data["size"] . 'X' . $data['wall'] : $data["size"] . 'X' . $data["second_size"] . 'X' . $data['wall'];
        };

//      для трубы
        if ($metal === 'Труба') {
            $data['title'] = $data["diameter"] . 'X' . $data['wall'];
        };

//      для листа
        if ($metal === 'Лист' || $metal === 'Лист рулонный') {
            $data['title'] = $data['thickness'];
        };

//      для квадратной трубы
        if ($metal === 'Труба квадратная') {
            $data['title'] = $data['width'] . 'X' . $data['height'] . 'X' . $data['wall'];
        };

//      для круга
        if ($metal === 'Круг') {
            $data['title'] = $data["diameter"];
        };

        unset($data['mark'], $data["diameter"], $data["size"], $data["second_size"], $data['wall'], $data['thickness'], $data['width'], $data['height']);

        Characteristic::query()->create($data);
    }
    public function updateCharacteristic(CharacteristicUpdateRequest $request, Characteristic $characteristic)
    {
        $data = $request->validated();
        $characteristic->update($data);
    }
    public function destroyCharacteristic(Characteristic $characteristic)
    {
        $characteristic->delete();
    }
    public function destroyMetal(Metal $metal)
    {
        $metal->delete();
    }

    public function standard(): \Inertia\Response|\Inertia\ResponseFactory
    {
        $metals = MetalResource::collection(Metal::all())->resolve();
        $standards = StandardResource::collection(Standard::all())->resolve();
        return inertia('Standard/Index', compact('standards', 'metals'));
    }

    public function storeStandard(StandardStoreRequest $request)
    {
        $data = $request->validated();

        $metal = new MetalResource(Metal::query()->where('title', $data['metal'])->get());
        $metal_id = $metal[0]['id'];
        $data['metal_id'] = $metal_id;

        unset($data['metal']);

        Standard::query()->create($data);
    }
    public function destroyStandard(Standard $standard)
    {
        $standard->delete();
    }
    public function units(): \Inertia\Response|\Inertia\ResponseFactory
    {
        $units = UnitResource::collection(Unit::all())->resolve();
        return inertia('Unit/Index', compact('units'));
    }

    public function storeUnits(UnitStoreRequest $request)
    {
        $data = $request->validated();
        Unit::query()->create($data);
    }
    public function destroyUnit(Unit $unit)
    {
        $unit->delete();
    }

    public function steel(): \Inertia\Response|\Inertia\ResponseFactory
    {
        $steels = SteelResource::collection(Steel::all())->resolve();
        return inertia('Steel/Index', compact('steels'));
    }
    public function storeSteel(SteelStoreRequest $request)
    {
        $data = $request->validated();
        $data['title'] = $data['title'] . ' ГОСТ ' . $data['steel_standard'];
        unset($data['steel_standard']);
        Steel::query()->create($data);
    }
    public function destroySteel(Steel $steel)
    {
        $steel->delete();
    }
}
