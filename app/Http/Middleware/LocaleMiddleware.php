<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        $langs =["en", "ru"];

        $currentLang = $request->session()->get("lang");

        if(!in_array($currentLang, $langs)){
            app()->setLocale('en');
        } else {
            app()->setLocale($currentLang);
        }

        return $next($request);
    }
}
