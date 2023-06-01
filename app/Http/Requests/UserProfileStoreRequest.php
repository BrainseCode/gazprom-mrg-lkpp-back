<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileStoreRequest extends FormRequest
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
            'short_name' => ['required', 'max:255', 'string'],
            'full_name' => ['required', 'max:255', 'string'],
            'responsible_person' => ['required', 'max:255', 'string'],
            'shared_phone' => ['required', 'max:255', 'string'],
            'responsible_phone' => ['required', 'max:255', 'string'],
            'legal_address' => ['required', 'max:255', 'string'],
            'postal_address' => ['required', 'max:255', 'string'],
            'inn' => ['required', 'max:255', 'string'],
            'kpp' => ['required', 'max:255', 'string'],
            'ogrn' => ['required', 'max:255', 'string'],
            'okpo' => ['required', 'max:255', 'string'],
            'okfs' => ['required', 'max:255', 'string'],
            'okato' => ['required', 'max:255', 'string'],
            'okopf' => ['required', 'max:255', 'string'],
            'oktmo' => ['required', 'max:255', 'string'],
            'okved' => ['required', 'max:255', 'string'],
            'okogu' => ['required', 'max:255', 'string'],
        ];
    }
}
