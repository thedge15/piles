<?php

namespace App\Http\Requests\Material;

use Illuminate\Foundation\Http\FormRequest;

class MaterialUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'element' => 'nullable|string',
            'title' => 'required|string',
            'weight' => 'nullable|numeric',
            'length' => 'nullable|numeric',
            'area' => 'nullable|numeric',
            'paint' => 'nullable|string',
            'numberOfLayers' => 'nullable|integer',
            'paint_color' => 'nullable|string',
        ];
    }
}
