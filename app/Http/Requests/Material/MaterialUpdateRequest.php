<?php

namespace App\Http\Requests\Material;

use App\Http\Requests\BaseRequest;

class MaterialUpdateRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|integer',
            'numb' => 'nullable|integer',
            'element' => 'nullable|string',
            'title' => 'nullable|string',
            'weight' => 'nullable|numeric',
            'length' => 'nullable|numeric',
            'area' => 'nullable|numeric',
            'paint' => 'nullable|string',
            'number_of_layers' => 'nullable|integer',
            'paint_color' => 'nullable|string',
            'is_pile' => 'nullable|boolean',
        ];
    }
}
