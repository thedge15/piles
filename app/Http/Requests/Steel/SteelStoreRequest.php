<?php

namespace App\Http\Requests\Steel;

use Illuminate\Foundation\Http\FormRequest;

class SteelStoreRequest extends FormRequest
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
            'title' => 'required|string',
            'steel_standard' => 'required|string',
        ];
    }
}
