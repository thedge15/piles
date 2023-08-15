<?php

namespace App\Http\Requests\Standard;

use App\Http\Requests\BaseRequest;

/**
 * @method static class()
 */
class StandardStoreRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'metal' => 'required|string',
            'title' => 'required|string',
        ];
    }
}
