<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

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

        $record = User::where('id', $request->user_id)->where('is_active', 1)->where('remember_token', $request->token)->get();

        if ($record->count()) {

            return $next($request);
        } else {
            return response(['message' => 'Not Authenticated'], 401);
        }

    }
}
