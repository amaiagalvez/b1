<?php

namespace Izt\Basics\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Developer
{

    /**
     * @param Request $request
     * @param Closure $next
     * @return RedirectResponse|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->isDeveloper()) {
            return $next($request);
        }

        Auth::logout();
        return redirect()->route(config('basics.redirect_route_after_logout'));
    }
}
