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
            'availability' => 'required|string|in:Full-time,Part-time',
            'bio' => 'required|string|max:1000',
        ];
    }

    /**
     * Get the custom validation messages for the request.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'user_id.required' => 'The user ID is required.',
            'user_id.exists' => 'The selected user ID is invalid.',
            'type_of_translator.required' => 'Please select at least one area of expertise.',
            'type_of_translator.array' => 'The expertise field must be an array.',
            'type_of_translator.*.string' => 'Each expertise type must be a string.',
            'language_pairs.required' => 'Please select at least one language pair.',
            'language_pairs.array' => 'The language pairs field must be an array.',
            'language_pairs.*.string' => 'Each language pair must be a string.',
            'years_of_experience.required' => 'Please enter your years of experience.',
            'years_of_experience.integer' => 'The years of experience must be an integer.',
            'rate_per_word.required' => 'Please enter your rate per word.',
            'rate_per_word.numeric' => 'The rate per word must be a number.',
            'rate_per_hour.required' => 'Please enter your rate per hour.',
            'rate_per_hour.numeric' => 'The rate per hour must be a number.',
            'availability.required' => 'Please select your availability.',
            'availability.string' => 'The availability field must be a string.',
            'availability.in' => 'The availability must be either Full-time or Part-time.',
            'bio.required' => 'Please provide a bio.',
            'bio.max' => 'The bio may not be greater than 1000 characters.',
        ];
    }
}
