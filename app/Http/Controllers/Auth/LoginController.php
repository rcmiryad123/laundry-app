<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function attemptLogin(Request $request)
    {
        // Cek apakah ada user dengan email tersebut dan status bukan '1'
        $user = \App\Models\User::where('email', $request->email)->where('status', '<>', '1')->first();

        if ($user && $this->guard()->attempt($this->credentials($request), $request->filled('remember'))) {
            // Jika user ditemukan dan statusnya bukan '1', maka login berhasil
            return true;
        }

        // Jika tidak, kembalikan false
        return false;
    }
}
