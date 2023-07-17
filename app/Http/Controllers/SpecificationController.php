<?php

namespace App\Http\Controllers;

use App\Actions\StoreMetalAction;
use App\Actions\StoreStandardAction;
use App\Actions\StoreSteelAction;
use App\Http\Requests\Characteristic\CharacteristicUpdateRequest;
use App\Http\Requests\Metal\StoreMetalRequest;
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
        $metals = CharacteristicResource::collection($metal->characteristics->sortBy('title', SORT_NATURAL));
        $metal = new MetalResource($metal);

        return inertia('Metal/Show', compact('metals', 'metal'));
    }

    public function storeCharacteristic(StoreMetalAction $action)
    {
        Characteristic::query()->create($action->handle());
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

    public function storeStandard(StoreStandardAction $action)
    {
        Standard::query()->create($action->handle());
    }
    public function destroyStandard(Standard $standard)
    {
        $standard->delete();
    }

    public function unit(): \Inertia\Response|\Inertia\ResponseFactory
    {
        $units = UnitResource::collection(Unit::all())->resolve();
        return inertia('Unit/Index', compact('units'));
    }

    public function storeUnit(UnitStoreRequest $request)
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
    public function storeSteel(StoreSteelAction $action)
    {
        Steel::query()->create($action->handle());
    }
    public function destroySteel(Steel $steel)
    {
        $steel->delete();
    }
}
