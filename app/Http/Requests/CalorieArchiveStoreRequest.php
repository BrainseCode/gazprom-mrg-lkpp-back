<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalorieArchiveStoreRequest extends FormRequest
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
            'date' => ['required', 'date'],
            'caloric' => ['required', 'numeric'],
            'quality_passport' => ['required', 'max:255', 'string'],
            'contract_id' => ['required', 'exists:contracts,id'],
        ];
    }
}
