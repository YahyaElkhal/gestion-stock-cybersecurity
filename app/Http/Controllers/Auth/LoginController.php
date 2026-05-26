<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller

{
    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $key = 'login-attempts:' . $request->ip();

    if (RateLimiter::tooManyAttempts($key, 5)) {

        throw ValidationException::withMessages([
            'email' => ['Trop de tentatives. Réessayez dans 1 minute.'],
        ]);
    }

    if (Auth::attempt($request->only('email', 'password'))) {

        RateLimiter::clear($key);

        $request->session()->regenerate();

        return redirect()->intended('/home');
    }

    RateLimiter::hit($key, 60);

    throw ValidationException::withMessages([
        'email' => ['Identifiants invalides.'],
    ]);
}
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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
