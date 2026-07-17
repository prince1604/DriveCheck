<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $roleMapping = [
            'admin' => 1,
            'employee' => 2,
        ];

        if (!auth()->check() || auth()->user()->user_type_id !== $roleMapping[$role]) {
            return redirect('/');
        }
        return $next($request);
    }
}
