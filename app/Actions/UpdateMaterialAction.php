<?php

namespace App\Actions;

use App\Http\Requests\Material\MaterialUpdateRequest;
use App\Models\Characteristic;
use App\Models\Material;
use App\Models\Paint;

/**
 * @property MaterialUpdateRequest $request
 */
class UpdateMaterialAction
{
    public function __construct(MaterialUpdateRequest $request)
    {
        $this->request = $request;
    }

    public function handle(): array
    {
        $data = $this->request->validated();

        $paint = Paint::query()->where('title', $data['paint'])->get()->toArray();

        $material = Material::query()->find($data['id']);

        $characteristic = Characteristic::query()->find($material['characteristic_id']);

        $data['length'] = $data['weight'] * $characteristic['ton_length'];
        $data['area'] = $data['weight'] * $characteristic['ton_area'];

        if ($data['paint'] && $data['number_of_layers']) {
            $data['paint_quantity'] = $paint[0]['consumption'] * $data['number_of_layers'] * $data['area'];
        } else if (!$data['paint'] && !$data['number_of_layers']) {
            unset($data['paint']);
        }

        if ($data['is_pile']) {
            $data['paint_quantity'] *= 0.483;
        }

        return $data;
    }
}
