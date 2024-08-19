<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Adjust as needed for authorization checks
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'project_name' => 'required|string|max:255',
            'project_description' => 'required|string|max:2000',
            'original_language' => 'required|string|max:255',
            'target_language' => 'required|string|max:255',
            'project_domain' => 'required|string|max:255',
            'project_start_date' => 'required|date|after_or_equal:today',
            'project_end_date' => 'required|date|after:project_start_date',
            'project_budget' => 'required|numeric|min:1',
            'editing_proofreading_allowed' => 'nullable|boolean',
            'bidding_allowed' => 'nullable|boolean',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'project_name' => 'project name',
            'project_description' => 'project description',
            'original_language' => 'original language',
            'target_language' => 'target language',
            'project_domain' => 'project domain',
            'project_start_date' => 'start date',
            'project_end_date' => 'end date',
            'project_budget' => 'project budget',
            'editing_proofreading_allowed' => 'editing/proofreading allowed',
            'bidding_allowed' => 'bidding allowed',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'project_name.required' => 'The project name is required.',
            'project_description.required' => 'The project description is required.',
            'original_language.required' => 'The original language is required.',
            'target_language.required' => 'The target language is required.',
            'project_domain.required' => 'The project domain is required.',
            'project_start_date.required' => 'The start date is required.',
            'project_start_date.after_or_equal' => 'The start date must be today or a future date.',
            'project_end_date.required' => 'The end date is required.',
            'project_end_date.after' => 'The end date must be after the start date.',
            'project_budget.required' => 'The project budget is required.',
            'project_budget.min' => 'The project budget must be at least 1 Rupee.',
        ];
    }
}
