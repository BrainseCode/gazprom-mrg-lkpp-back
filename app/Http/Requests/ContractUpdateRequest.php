<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContractUpdateRequest extends FormRequest
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
            'user_id' => ['required', 'exists:users,id'],
            'number' => ['required', 'numeric'],
            'name' => ['required', 'max:255', 'string'],
            'reporting_hour' => ['required', 'date_format:H:i:s'],
            'registration_date' => ['required', 'date'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'arrears' => ['required', 'numeric'],
            'request_approval_unevenness_id' => [
                'required',
                'exists:request_approval_unevennesses,id',
            ],
        ];
    }
}
