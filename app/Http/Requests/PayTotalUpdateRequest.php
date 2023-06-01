<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PayTotalUpdateRequest extends FormRequest
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
            'pay_delivered' => ['required', 'numeric'],
            'pay_planned' => ['required', 'numeric'],
            'pay_tovdgo' => ['required', 'numeric'],
            'total' => ['required', 'numeric'],
            'total_nds' => ['required', 'numeric'],
            'contract_id' => ['required', 'exists:contracts,id'],
        ];
    }
}
