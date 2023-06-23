<?php

namespace App\Http\Requests\Bush;

use Illuminate\Foundation\Http\FormRequest;

class ProjectStoreRequest extends FormRequest
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
            'bush_id' => 'required|integer',
            'title' => 'required|string',
            'change' => 'nullable|integer',
        ];
    }
}
