<?php

namespace App\Http\Requests\Metal;

use App\Http\Requests\BaseRequest;

class MetalStoreRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string'
        ];
    }
}
