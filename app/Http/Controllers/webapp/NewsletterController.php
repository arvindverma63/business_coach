<?php

namespace App\Http\Controllers\webapp;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'nullable|string|max:255',
            'email' => 'required|email|max:255'
        ]);

        if ($validator->fails()) {
            $message = $validator->errors()->first();
            if (strpos($message, 'email') !== false) {
                $message = 'Please provide a valid email address.';
            }
            return $this->respondWithError($request, $message);
        }

        $subscriber = Newsletter::where('email', $request->email)->first();

        if ($subscriber) {
            if (!$subscriber->is_active) {
                $subscriber->update([
                    'is_active' => true,
                    'name' => $request->name ?? $subscriber->name // Update name if provided
                ]);
                return $this->respondWithSuccess($request, 'Welcome back! Your subscription is reactivated.');
            }
            return $this->respondWithError($request, 'This email is already subscribed.');
        }

        Newsletter::create([
            'name'  => $request->name,
            'email' => $request->email,
            'is_active' => true,
        ]);

        return $this->respondWithSuccess($request, 'Thank you for subscribing!');
    }

    private function respondWithError($request, $message)
    {
        if ($request->expectsJson()) {
            return response()->json(['success' => false, 'message' => $message], 422);
        }
        return back()->with('error', $message)->withInput();
    }

    private function respondWithSuccess($request, $message)
    {
        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => $message], 200);
        }
        return back()->with('success', $message);
    }
}
