<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
use App;
use Config;

class Localization
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
        if (Session::has('locale')&& array_key_exists(Session::get('locale'),Config::get('app.languages'))) {
            App::setLocale(Session::get('locale'));
        }
        else{
            App::setLocale(Config::get('app.fallback_locale'));
        }
        return $next($request);
    }
}
