<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {

                // Admin Guard
                if ($guard === 'admin') {
                    return redirect()->route('/dashboard'); // మీ admin dashboard route
                }

                                               // Customer / Default Web Guard
                return redirect()->route('/'); // మీ customer dashboard route
            }
        }

        return $next($request);
    }
}
