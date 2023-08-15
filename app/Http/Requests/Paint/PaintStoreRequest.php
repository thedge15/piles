<?php

namespace App\Http\Requests\Paint;

use App\Http\Requests\BaseRequest;

class PaintStoreRequest extends BaseRequest
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
            'consumption' => 'required|numeric',
        ];
    }
}
