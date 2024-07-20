<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            'company_name' => 'nullable|string|max:255',
            'contact_name' => 'required|string|max:255',
            'contact_phone' => 'nullable|string|max:255',
            'company_address' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'industry' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:5000',
            'slug' => 'nullable|string|unique:clients,slug',
        ];
    }
}
