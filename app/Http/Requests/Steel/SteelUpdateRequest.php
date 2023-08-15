<?php

namespace App\Http\Requests\Steel;

use App\Http\Requests\BaseRequest;

class SteelUpdateRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
        ];
    }
}
