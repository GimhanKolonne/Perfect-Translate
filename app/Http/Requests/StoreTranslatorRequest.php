<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTranslatorRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'type_of_translator' => 'required|array',
            'type_of_translator.*' => 'string',
            'language_pairs' => 'required|array',
            'language_pairs.*' => 'string',
            'years_of_experience' => 'required|integer|min:0',
            'rate_per_word' => 'required|numeric|min:0',
            'rate_per_hour' => 'required|numeric|min:0',
            'availability' => 'required|string',
            'bio' => 'required|string',
        ];
    }
}
