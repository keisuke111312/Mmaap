<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RoleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $user->role === 'admin') {
            return $next($request);
        }

        if ($user && $user->role === 'client') {
            return redirect('/home')->with('message', 'Access Denied');
        }

        // Default response for all other roles or unauthenticated users
        return redirect('/')->with('message', 'Unauthorized Access');
    }
}
