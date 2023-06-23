<?php

namespace App\Http\Requests\Characteristic;

use Illuminate\Foundation\Http\FormRequest;

class CharacteristicStoreRequest extends FormRequest
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
            'metal_id' => 'required|integer',
            'mark' => 'nullable|string',
            'diameter' => 'nullable|numeric',
            'size' => 'nullable|integer',
            'second_size' => 'nullable|integer',
            'width' => 'nullable|integer',
            'height' => 'nullable|integer',
            'wall' => 'nullable|integer',
            'thickness' => 'nullable|integer',
            'sheet_width' => 'nullable|integer',
            'sheet_height' => 'nullable|integer',
            'ton_length' => 'nullable|numeric',
            'ton_area' => 'required|numeric'
        ];
    }
}
