<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
{
    $guards = empty($guards) ? [null] : $guards;

    foreach ($guards as $guard) {
        if (Auth::guard($guard)->check()) {
            $user = Auth::guard($guard)->user();
            
            \Log::info('RedirectIfAuthenticated - User role: ' . $user->role);
            
            return $user->isSuperAdmin() 
                ? redirect('/dashboard')
                : redirect()->route('halamanuser.index');
        }
    }

    return $next($request);
}
}