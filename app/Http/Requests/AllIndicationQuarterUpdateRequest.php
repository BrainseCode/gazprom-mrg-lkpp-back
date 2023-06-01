<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AllIndicationQuarterUpdateRequest extends FormRequest
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
            'date_year' => ['required', 'numeric'],
            'year' => ['required', 'numeric'],
            'quarter_1' => ['required', 'numeric'],
            'quarter_2' => ['required', 'numeric'],
            'quarter_3' => ['required', 'numeric'],
            'quarter_4' => ['required', 'numeric'],
            'january' => ['required', 'numeric'],
            'february' => ['required', 'numeric'],
            'march' => ['required', 'numeric'],
            'april' => ['required', 'numeric'],
            'may' => ['required', 'numeric'],
            'june' => ['required', 'numeric'],
            'july' => ['required', 'numeric'],
            'august' => ['required', 'numeric'],
            'september' => ['required', 'numeric'],
            'october' => ['required', 'numeric'],
            'november' => ['required', 'numeric'],
            'december' => ['required', 'numeric'],
            'contract_id' => ['required', 'exists:contracts,id'],
        ];
    }
}
