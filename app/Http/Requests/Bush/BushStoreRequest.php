<?php

namespace App\Http\Requests\Bush;

use App\Http\Requests\BaseRequest;

class BushStoreRequest extends BaseRequest
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
