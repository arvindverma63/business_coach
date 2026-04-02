<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  int  $type  The required user_type (0, 1, 2, or 3)
     */
    public function handle(Request $request, Closure $next, ...$types): Response
    {
        if (!Auth::check()) {
            return redirect()->route('user.login');
        }

        $user = Auth::user();
        $allowedTypes = collect($types)
            ->flatMap(fn ($type) => explode(',', (string) $type))
            ->map(fn ($type) => trim($type))
            ->filter(fn ($type) => $type !== '')
            ->map(fn ($type) => (int) $type)
            ->values()
            ->all();

        if (!in_array((int) $user->user_type, $allowedTypes, true)) {

            return match ((int)$user->user_type) {
                0, 1    => redirect()->route('dashboard'),
                2       => redirect()->route('coach.dashboard')
                            ->with('error', 'Access restricted to your dashboard.'),
                3       => redirect()->route('seeker.dashboard'), // Adjust route name as needed
                default => abort(403, 'Unauthorized action.'),
            };
        }

        return $next($request);
    }
}
