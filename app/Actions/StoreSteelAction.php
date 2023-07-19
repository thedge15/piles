<?php

namespace App\Actions;

use App\Http\Requests\Steel\SteelStoreRequest;

/**
 * @property SteelStoreRequest $request
 */
class StoreSteelAction
{
    public function __construct(SteelStoreRequest $request)
    {
        $this->request = $request;
    }

    public function handle(): array
    {
        $data = $this->request->validated();
        $data['title'] = $data['title'] . ' ГОСТ ' . $data['steel_standard'];
        unset($data['steel_standard']);

        return $data;
    }
}
