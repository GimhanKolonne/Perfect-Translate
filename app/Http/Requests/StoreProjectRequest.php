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
            'user_id' => 'required|exists:users,id',
            'project_name' => 'required|string|max:255',
            'project_description' => 'nullable|string',
            'original_language' => 'nullable|string',
            'target_language' => 'nullable|string',
            'project_domain' => 'nullable|string',
            'project_start_date' => 'nullable|date',
            'project_end_date' => 'nullable|date',
            'project_budget' => 'nullable|numeric|min:0',
            'editing_proofreading_allowed' => 'nullable|boolean',
            'bidding_allowed' => 'nullable|boolean',

        ];
    }
}
