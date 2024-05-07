<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    }
    protected function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');

        // You can add additional conditions here if needed, like checking if the account is active
        return $credentials;
    }
    public function login(Request $request)
{
    $this->validateLogin($request);

    // Attempt to log the user in
    if (method_exists($this, 'hasTooManyLoginAttempts') &&
        $this->hasTooManyLoginAttempts($request)) {
        $this->fireLockoutEvent($request);

        return $this->sendLockoutResponse($request);
    }

    $credentials = $this->credentials($request);

    if ($this->guard()->attempt($credentials, $request->filled('remember'))) {
        return $this->sendLoginResponse($request);
    }

    // If login attempt fails
    $this->incrementLoginAttempts($request);

    // Custom error messages
    if ($this->guard()->getProvider()->retrieveByCredentials($credentials)) {
        // User found, wrong password
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([
                'password' => __('The password is incorrect.'),
            ]);
    } else {
        // User not found
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([
                $this->username() => __('The email is not registered in the system.'),
            ]);
    }
}

    }
