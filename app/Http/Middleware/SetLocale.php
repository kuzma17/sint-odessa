<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        $locale = $request->segment(1);

        if (in_array($locale, config('app.locales'))) {
            app()->setLocale($locale);
        } else {
            app()->setLocale(config('app.default_locale'));
        }

        return $next($request);
    }

}
