<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThermometerStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'measuring_complex_id' => [
                'required',
                'exists:measuring_complexes,id',
            ],
            'name' => ['required', 'max:255', 'string'],
            'number' => ['required', 'numeric'],
            'verification_date' => ['required', 'date'],
        ];
    }
}
