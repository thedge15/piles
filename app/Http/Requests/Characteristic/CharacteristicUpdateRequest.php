<?php

namespace App\Http\Requests\Characteristic;

use App\Http\Requests\BaseRequest;

class CharacteristicUpdateRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title' => 'nullable|string',
            'ton_length' => 'nullable|numeric',
            'ton_area' => 'nullable|numeric',
        ];
    }
}
