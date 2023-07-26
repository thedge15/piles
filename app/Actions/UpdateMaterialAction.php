<?php

namespace App\Actions;

use App\Http\Requests\Material\MaterialUpdateRequest;
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

        if ($data['paint'] && $data['numberOfLayers']) {
            $data['paint_quantity'] = $paint[0]['consumption'] * $data['numberOfLayers'] * $data['area'];
        } else if (!$data['paint'] && !$data['numberOfLayers']) {
            unset($data['paint']);
            unset($data['numberOfLayers']);
        }

        unset($data['numberOfLayers']);

        return $data;
    }
}
