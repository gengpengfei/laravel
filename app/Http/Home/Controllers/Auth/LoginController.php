<?php

namespace App\Http\Home\Controllers\Auth;

use App\Http\Home\Controllers\Controller;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use ThrottlesLogins,RedirectsUsers;
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    /*
     * params :登录页面
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/31 17:54
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }
    /*
     * params :登录
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/31 15:14
     */
    public function login(Request $request)
    {
        //-- 多站点登录判断
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        //-- 登录
        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }
    
    /*
     * params :退出登录
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/31 17:55
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect()->to('/');
    }

    /**
     * 登录操作
     */
    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    /**
     * 获取验证字段
     */
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    /**
     * 登录成功跳转
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        //
    }

    /**
     * 登录失败跳转
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    /**
     *获取校验字段
     */
    public function username()
    {
        return 'username';
    }

    /**
     * 校验保护
     */
    protected function guard()
    {
        return Auth::guard();
    }
}
