<?php

namespace App\Http\Controllers\webapp;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function coachRegistration(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'gender' => 'nullable|string|in:male,female,other',
            'experience_years' => 'nullable|integer|min:0',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'linkedin_url' => 'nullable|url|max:255',
            'website_url' => 'nullable|url|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle profile picture upload
        $profilePicturePath = null;
        if ($request->hasFile('profile_picture') && $request->file('profile_picture')->isValid()) {
            $file = $request->file('profile_picture');
            $filename = 'coach_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $profilePicturePath = $file->storeAs('users/coaches', $filename, 'public');
        }

        // Create user with user_type = 2 for coaches

        $user = \App\Models\User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['email']),
            'user_type' => 2,
            'profile_image' => $profilePicturePath ? 'storage/' . $profilePicturePath : null,
        ]);

        if($user){
            \App\Models\CoachProfile::create([
                'user_id' => $user->id,
                'approval_status' => 'pending',
                'gender' => $validated['gender'] ?? null,
                'show_personal_details' => true,
                'is_visible' => false,
                'is_featured' => false,
                'ranking_score' => 0,
                'profile_views' => 0,
                'total_interactions' => 0,
                'current_rank' => null,
                'experience_years' => $validated['experience_years'] ?? null,
                'city' => $validated['city'] ?? null,
                'state' => $validated['state'] ?? null,
                'country' => $validated['country'] ?? null,
                'designation' => $validated['designation'] ?? null,
                'company_name' => $validated['company_name'] ?? null,
                'bio' => $validated['bio'] ?? null,
                'linkedin_url' => $validated['linkedin_url'] ?? null,
                'website_url' => $validated['website_url'] ?? null,
            ]);
        }

        // Return JSON response for AJAX requests
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Registration successful! Your profile is pending approval.',
                'redirect' => route('user.login')
            ], 201);
        }

        return redirect()->route('user.login')->with('success', 'Registration successful! Your profile is pending approval.');
    }

    public function seekerRegistration(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'business_domain' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
        ]);

        // Handle profile image upload
        $profileImagePath = null;
        if ($request->hasFile('profile_image') && $request->file('profile_image')->isValid()) {
            $file = $request->file('profile_image');
            $filename = 'seeker_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $profileImagePath = $file->storeAs('users/seekers', $filename, 'public');
        }

        // Create user with user_type = 1 for seekers
        $user = \App\Models\User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'profile_image' => $profileImagePath ? 'storage/' . $profileImagePath : null,
            'password' => bcrypt($validated['email']),
            'user_type' => 3, // 1 for seeker, 2 for coach
        ]);

        if($user){
            \App\Models\SeekerProfile::create([
                'user_id' => $user->id,
                'business_domain' => $validated['business_domain'] ?? null,
                'company_name' => $validated['company_name'] ?? null,
                'city' => $validated['city'] ?? null,
                'state' => $validated['state'] ?? null,
                'is_verified' => false,
                'notification_preferences' => [
                    'email_notifications' => true,
                    'sms_notifications' => false,
                    'push_notifications' => true,
                ],
            ]);
        }

        // Return JSON response for AJAX requests
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Registration successful! Please log in to your account.',
                'redirect' => route('user.login')
            ], 201);
        }

        return redirect()->route('user.login')->with('success', 'Registration successful! Please log in to your account.');
    }
}
