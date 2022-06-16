<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {

            return route('cms.login', 'admin');
        }
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
