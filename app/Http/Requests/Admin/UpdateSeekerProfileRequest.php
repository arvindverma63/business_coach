<?php

namespace App\Http\Requests\Admin;

use App\Models\SeekerProfile;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UpdateSeekerProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $routeSeeker = $this->route('seeker') ?? $this->route('id');
        $seekerId = $routeSeeker instanceof SeekerProfile ? $routeSeeker->getKey() : $routeSeeker;
        $seeker = SeekerProfile::query()->find($seekerId);
        $userId = $seeker?->user_id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'digits:10', Rule::unique('users', 'phone',)->ignore($userId, 'id')],
            'business_domain' => ['nullable', 'string', 'max:255'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'notification_preferences' => ['nullable', 'array'],
            'is_verified' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'phone.unique' => 'This phone number is already in use.',
            'phone.digits' => 'Phone number must be exactly 10 digits.',
        ];
    }
}
