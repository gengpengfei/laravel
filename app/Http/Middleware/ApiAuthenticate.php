<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate;
use Closure;

/*
 * explain:接口验证中间件
 * instruc:重写auth中间件用于passport返回
 * authors:Mr.Geng
 * addTime:2018/1/5 10:20
 */
class ApiAuthenticate extends Authenticate
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected $except = [
        //
    ];
    public function handle($request, Closure $next, ...$guards)
    {
        if($userInfo = $this->authenticate($guards)){
            $request->attributes->add(compact('userInfo'));
            return $next($request);
        }
        return response()->json(array("data"=>'-1',"msg"=>"权限不足","code"=>404));
    }

    protected function authenticate(array $guards)
    {
        if ($this->auth->guard('api')->check()) {
            return $this->auth->guard('api')->user();
        }
        return false;
    }
}
