<?php

namespace App\Http\Requests\Material;

use App\Http\Requests\BaseRequest;

class MaterialStoreRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'project_id' => 'required|integer',
            'metal_id' => 'required|integer',
            'numb' => 'nullable|integer',
            'element' => 'nullable|string',
            'metal' => 'required|string',
            'title' => 'required|string',
            'metalLength' => 'nullable|numeric',
            'sheetHeight' => 'nullable|integer',
            'sheetWidth' => 'nullable|integer',
            'standard' => 'required|string',
            'steel' => 'required|string',
            'quantity' => 'required|numeric',
            'measure_units' => 'required|string',
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'Заполните размеры.',
            'standard.required' => 'Укажите ГОСТ.',
            'steel.required' => 'Укажите сталь.',
            'quantity.required' => 'Укажите количество.',
            'measure_units.required' => 'Укажите единицы измерения.',
        ];
    }
}
