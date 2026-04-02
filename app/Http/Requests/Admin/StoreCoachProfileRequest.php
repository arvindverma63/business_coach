<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreCoachProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',

            'gender' => 'nullable|in:male,female,other',
            'company_name' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'linkedin_url' => 'nullable|url|max:255',
            'website_url' => 'nullable|url|max:255',
            'experience_years' => 'nullable|integer|min:0',
            'bio' => 'nullable|string',

            'categories' => 'nullable|array',
            'categories.*' => 'nullable|string' // Removed 'exists' to allow new tag strings
        ];
    }
}
