<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminOnly
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if ($request->user()->role !== User::ADMIN)
            return abort(Response::HTTP_FORBIDDEN);

        return $next($request);
    }
}
