<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            redirect('/');
        }
    }

    /**
     *  Handle an incoming request
     *  @param  \Illuminate\Http\Request  $request
     *  @param  \Closure $next
     *  @param  string\null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if (!Auth::check()) {
            return ($request->ajax() || $request->wantsJson() ? abort('401') : redirect('/'));
        }

        return $next($request);
    }
}
