<?php

namespace App\Actions;

use App\Http\Requests\Standard\StandardStoreRequest;
use App\Http\Resources\Metal\MetalResource;
use App\Models\Metal;

/**
 * @property StandardStoreRequest $request
 */
class StoreStandardAction
{

    public function __construct(StandardStoreRequest $request)
    {
        $this->request = $request;
    }

    public function handle()
    {
        $data = $this->request->validated();


        $metal = new MetalResource(Metal::query()->where('title', $data['metal'])->get());
        $metal_id = $metal[0]['id'];
        $data['metal_id'] = $metal_id;

        unset($data['metal']);

        return $data;
    }
}
