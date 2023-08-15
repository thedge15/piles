<?php

namespace App\Http\Requests\Element;

use App\Http\Requests\BaseRequest;

class ElementUpdateRequest extends BaseRequest
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
