<?php

namespace App\Http\Middleware;

use Closure;

class ActiveAccount
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (auth()->user()->reset_password_required)
            return redirect()->route("account");

        return $next($request);
    }
}
