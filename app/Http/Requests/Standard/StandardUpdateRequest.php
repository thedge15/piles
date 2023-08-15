<?php

namespace App\Http\Requests\Standard;

use App\Http\Requests\BaseRequest;

/**
 * @method static class()
 */
class StandardUpdateRequest extends BaseRequest
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
