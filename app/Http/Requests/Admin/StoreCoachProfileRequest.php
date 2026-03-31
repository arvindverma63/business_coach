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
            'show_personal_details' => 'boolean',
            'company_name' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'country' => 'required|in:India',
            'linkedin_url' => 'nullable|url|max:255',
            'website_url' => 'nullable|url|max:255',
            'experience_years' => 'nullable|integer|min:0',
            'bio' => 'nullable|string',
            'ranking_score' => 'nullable|integer|min:0',
            'current_rank' => 'nullable|integer|min:1',

            'categories' => 'nullable|array',
            'categories.*' => 'nullable|string' // Removed 'exists' to allow new tag strings
        ];
    }
}
