<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class userStateActive
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
        if (auth()->user()->user_state !=1) {
            Auth::logout();
            $validator = Validator::make([], [], $messages = []);
            $validator->errors()->add(
                'warning_Account',
                'Su sesión ha terminado porque su cuenta ha sido suspendida!'
            );
            $errors = $validator->errors();
            return redirect('/')->with('errors', $errors);
        }
        return $next($request);
    }
}
