<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SaveLocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->method() != 'GET' && ($locale = $request->input('save_locale'))) {
            \App::setLocale($locale);
        }

        return $next($request);
    }
}
