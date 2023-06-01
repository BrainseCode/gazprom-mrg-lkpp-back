<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PayTovdgoStoreRequest extends FormRequest
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
            'summ' => ['required', 'numeric'],
            'status_pay' => ['required', 'boolean'],
            'contract_id' => ['required', 'exists:contracts,id'],
        ];
    }
}
