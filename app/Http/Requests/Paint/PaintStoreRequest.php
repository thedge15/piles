<?php

namespace App\Http\Requests\Paint;

use Illuminate\Foundation\Http\FormRequest;

class PaintStoreRequest extends FormRequest
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
            'consumption' => 'required|numeric',
            'color' => 'nullable|string',
        ];
    }
}
