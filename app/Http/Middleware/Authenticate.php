<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Arr;

class Authenticate extends Middleware
{
    protected $guards;

    public function handle($request, Closure $next, ...$guards)
    {
        $this->guards = $guards;

        return parent::handle($request, $next, ...$guards);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            if (Arr::first($this->guards) === 'admin') {
                return route('cms.login', 'admin');

            } elseif (Arr::first($this->guards) === 'supervisor') {
                return route('cms.login', 'supervisor');

            } elseif (Arr::first($this->guards) === 'student') {
                return route('cms.login', 'student');

            } elseif (Arr::first($this->guards) === 'trainer') {
                return route('cms.login', 'trainer');

            }
        }
        return route('home');
    }


////            if ($request->is('admin') || $request->is('cms/admin/*')) {
////                return route('cms.login','admin');
////            }
////            if ($request->is('supervisor') || $request->is('cms/supervisor/*')) {
////                return route('cms.login','supervisor');
////            }
////            if ($request->is('student') || $request->is('cms/student/*')) {
////                return route('cms.login','student');
////            }
////            if ($request->is('trainer') || $request->is('cms/trainer/*')) {
////                return route('cms.login','trainer');
////            }

}
