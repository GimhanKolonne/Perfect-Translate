<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePortfolioRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'role_description' => 'required|string',
            'overview' => 'required|string',
            'relevant_skills' => 'nullable|string',
            'tags' => 'nullable|string',
            'media.*' => 'nullable|file|mimes:jpg,jpeg,png,mp4,pdf|max:10240', // 10MB max per file
            'detailed_description' => 'required|string',
            'status' => 'in:Draft,Published',
            'translator_id' => 'required|exists:translators,id',
        ];
    }
}
