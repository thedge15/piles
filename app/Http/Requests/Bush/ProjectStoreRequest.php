<?php

namespace App\Http\Requests\Bush;

use App\Http\Requests\BaseRequest;

class ProjectStoreRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'bush_id' => 'required|integer',
            'title' => 'required|string',
            'change' => 'nullable|integer',
        ];
    }
}
