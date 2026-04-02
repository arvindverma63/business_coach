<?php

namespace App\Http\Requests\Admin;

use App\Models\CoachProfile;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCoachProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $routeCoach = $this->route('coach') ?? $this->route('id');
        $coachId = $routeCoach instanceof CoachProfile ? $routeCoach->getKey() : $routeCoach;
        $coach = CoachProfile::query()->find($coachId);
        $userId = $coach?->user_id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($userId, 'id')],
            'phone' => ['nullable', 'string', 'max:20', Rule::unique('users', 'phone')->ignore($userId, 'id')],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'gender' => 'nullable|in:male,female,other',
            'company_name' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'linkedin_url' => 'nullable|url|max:255',
            'experience_years' => 'nullable|integer|min:0',
            'bio' => 'nullable|string',
            'is_visible' => 'boolean',
            'is_featured' => 'boolean',
            'approval_status' => 'sometimes|in:pending,approved,rejected',

            'categories' => 'nullable|array',
            'categories.*' => 'nullable|string' // Removed 'exists' to allow new tag strings
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'This email address is already in use.',
            'phone.unique' => 'This phone number is already in use.',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'is_featured' => $this->has('is_featured') ? 1 : 0,
            'is_visible' => $this->has('is_visible') ? 1 : 0,
        ]);
    }
}
