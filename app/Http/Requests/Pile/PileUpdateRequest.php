<?php

namespace App\Http\Requests\Pile;

use Illuminate\Foundation\Http\FormRequest;

class PileUpdateRequest extends FormRequest
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
            'tube' => 'required|string',
            'length' => 'required|integer',
            'altitude_mark' => 'required|integer',
        ];
    }
}
