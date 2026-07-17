<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckActiveStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $user = auth()->user();
            if ($user->user_type_id == 2 && !$user->is_active) {
                auth()->logout();
                return redirect()->route('login')->with('error', 'Your account is pending Admin approval.');
            }
        }
        return $next($request);
    }
}
