<?php

namespace App\Actions;

use App\Http\Requests\Characteristic\CharacteristicStoreRequest;
use App\Models\Metal;

/**
 * @property CharacteristicStoreRequest $request
 */
class StoreMetalAction
{
    public function __construct(CharacteristicStoreRequest $request)
    {
        $this->request = $request;
    }

    public function handle(): array
    {
        $data = $this->request->validated();
        $metal = Metal::query()->find($data['metal_id'])->title;

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

        return $data;
    }
}
