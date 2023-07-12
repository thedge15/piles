<?php

namespace App\Http\Requests\Standard;

use Illuminate\Foundation\Http\FormRequest;

class StandardStoreRequest extends FormRequest
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
            'metal' => 'required|string',
            'title' => 'required|string',
        ];
    }
}
