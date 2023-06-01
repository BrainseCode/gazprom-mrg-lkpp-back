<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndicationStoreRequest extends FormRequest
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
            'connection_point_id' => [
                'required',
                'exists:connection_points,id',
            ],
            'date' => ['required', 'date'],
            'volume' => ['required', 'numeric'],
            'plan' => ['required', 'numeric'],
        ];
    }
}
