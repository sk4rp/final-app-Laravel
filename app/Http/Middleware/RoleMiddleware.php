<?php

namespace App\Http\Middleware;


use App\Enums\RoleEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role): mixed
    {
        if (!Auth::check() || Auth::user()->role !== $role) {
            return redirect('/');
        }

        return $next($request);
    }
}
