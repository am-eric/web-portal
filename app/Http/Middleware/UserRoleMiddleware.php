<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;

class UserRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$userType)
    {
        $user = Auth::user();

        if ($user && in_array($user->usertype, $userType)) {
            return $next($request);
        }

       //abort(403, 'Unauthorized');
       return redirect()->back()->with('error', 'You are not authorized to access this page');
    }
}
