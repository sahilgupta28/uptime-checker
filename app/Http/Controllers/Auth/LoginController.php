<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    protected function redirectTo()
    {
        if (auth()->User()->role == config('constants.ROLE.ADMIN')) {
            return route('admin.dashboard');
        }
        return route('home');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
