<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        if (!empty($user) && $user->is_admin !== 1) {
            auth()->logout();
            session()->flash('error', 'You don"t have permission to access this content');
            return redirect(route('login'));
        }
        return $next($request);
    }
}
