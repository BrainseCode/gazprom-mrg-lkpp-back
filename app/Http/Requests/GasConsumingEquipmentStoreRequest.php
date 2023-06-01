<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GasConsumingEquipmentStoreRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'string'],
            'quantity' => ['required', 'numeric'],
            'power' => ['required', 'numeric'],
            'consumption' => ['required', 'numeric'],
        ];
    }
}
