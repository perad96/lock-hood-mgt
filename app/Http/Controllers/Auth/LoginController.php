<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function redirectTo()
    {
        $role = Auth::user()->role;

        switch ($role) {
            case 'ADMIN':
                return '/admin';
            case 'SALES':
                return '/sales-and-marketing';
            case 'FINANCE':
                return '/finance';
            case 'HR':
                return '/hr';
            case 'WORKER':
                return '/worker';
            case 'SUPERVISOR':
                return '/supervisor';
            default:
                return '/login';
        }
    }

//    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
