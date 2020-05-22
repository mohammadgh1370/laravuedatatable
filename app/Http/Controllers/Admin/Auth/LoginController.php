<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'user/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    // گارد ادمین
    protected function guard()
    {
        return Auth::guard('admin');
    }

    // صفحه ورود
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    // ورود ادمین
    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    // اعتبار سنجی اطلاعات ارسالی
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string|IranMobile',
            'password' => 'required|string',
            'captcha' => 'required|captcha'
        ]);
    }

    // فیلد اعتبار سنجی
    public function username()
    {
        return 'mobile';
    }

    // مسیر ریدایرکت بعد از لاگین
    public function redirectPath()
    {
        return route('admin.dashboard');
    }
}
