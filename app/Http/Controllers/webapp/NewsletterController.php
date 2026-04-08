<?php

namespace App\Http\Controllers\webapp;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $email = mb_strtolower(trim((string) $request->input('email')));
        $name = trim((string) $request->input('name', ''));

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

        if ($email === '') {
            return $this->respondWithError($request, 'Please provide a valid email address.');
        }

        $subscriber = Newsletter::whereRaw('LOWER(email) = ?', [$email])->first();

        if ($subscriber) {
            if (!$subscriber->is_active) {
                $subscriber->update([
                    'is_active' => true,
                    'name' => $name !== '' ? $name : $subscriber->name
                ]);
                return $this->respondWithSuccess($request, 'Welcome back! Your subscription is reactivated.');
            }
            return $this->respondWithError($request, 'This email is already subscribed.');
        }

        try {
            Newsletter::create([
                'name'  => $name !== '' ? $name : null,
                'email' => $email,
                'is_active' => true,
            ]);
        } catch (QueryException $e) {
            if ($this->isDuplicateEmailException($e)) {
                return $this->respondWithError($request, 'This email is already subscribed.');
            }

            throw $e;
        }

        return $this->respondWithSuccess($request, 'Thank you for subscribing!');
    }

    private function isDuplicateEmailException(QueryException $e): bool
    {
        return str_contains($e->getMessage(), 'Duplicate') || str_contains($e->getMessage(), 'UNIQUE');
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
