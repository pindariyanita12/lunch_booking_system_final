<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class isActive
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

        $abc = $request->mail;

        $record = User::where('email', $abc)->where('is_active',1)->get();

        // dd($record);

        if ($record->count()) {
       //     dd('hello');
            return $next($request);
        } else {
            return response(['message' => 'Not Authenticated'], 401);
        }

    }
}
