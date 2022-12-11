<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{

//    public function handle($request, Closure $next, ...$guards)
//    {
//        $guards = empty($guards) ? [null] : $guards;
//
//        foreach ($guards as $guard) {
//            if (Auth::guard($guard)->check()) {
//                return redirect(RouteServiceProvider::HOME);
//            }
//        }
//
//        return $next($request);
//    }


    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->role;

            switch ($role) {
                case 'ADMIN':
                    return redirect('/admin');
                case 'SALES':
                    return redirect('/sales-and-marketing');
                case 'FINANCE':
                    return redirect('/finance');
                case 'HR':
                    return redirect('/hr');
                case 'CUSTOMER':
                    return redirect('/customer');
                default:
                    return redirect('/login');
            }
        }

        return $next($request);
    }
}
