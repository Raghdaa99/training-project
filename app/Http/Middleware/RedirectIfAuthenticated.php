<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param string|null ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if (Auth::guard('admin')->check()) {
                    return redirect(RouteServiceProvider::HOME);
                } elseif (Auth::guard('student')->check()) {
                    return redirect(RouteServiceProvider::SHOW_STU_COM);
                } elseif (Auth::guard('supervisor')->check()) {
                    return redirect(RouteServiceProvider::SHOW_STU_SUP);
                } elseif (Auth::guard('trainer')->check()) {
                    return redirect(RouteServiceProvider::SHOW_STU_TRA);
                }
            }
        }

        return $next($request);
    }
}
