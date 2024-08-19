<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApplicationRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'project_id' => 'required|integer',
            'user_id' => 'required|integer',
            'status' => 'required|string',
            'application_message' => 'required|string',
            'cv' => 'nullable|mimes:pdf|max:2048',
            'contact_email' => 'required|email',
            'contact_phone' => 'required|string',
            'language_proficiency' => 'required|string',

        ];
    }
}
