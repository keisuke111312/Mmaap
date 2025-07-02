<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EnsureUserIsMember
{
    public function handle(Request $request, Closure $next)
    {
        if (Gate::allows('is-member')) {
            return $next($request);
        }

        abort(403, 'You must be a member to access this page.');
    }
}