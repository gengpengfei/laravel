<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

/*
 * explain:验证中间件
 * instruc:截获input表单提交字段,进行验证处理
 * authors:Mr.Geng
 * addTime:2018/1/5 10:24
 */
class ValidatorMiddle
{
    public function __construct()
    {
        //-- 自定义手机号验证
        Validator::extend('mobile', function($attribute, $value, $parameters)
        {
            return preg_match('/^0?(13[0-9]|15[012356789]|18[0-9]|14[57])[0-9]{8}$/', $value);
        });

    }
    protected $validators = [
        'username' => 'required|string|between:6,12',
        'password' => 'required|string|between:6,12',
        'mobile' => 'required|string|mobile',
    ];

    public function handle(Request $request, Closure $next)
    {
        if($validator = $this->validator($request->all())){
            if($error = $validator->errors()->first()){
                if($request->expectsJson()){
                    return response()->json(array("data"=>'-1',"msg"=>$validator->errors(),"code"=>4000));
                }
                return $validator->validate();
            }
        }
        return $next($request);
    }

    protected function validator(array $data)
    {
        foreach ($data as $key=>$v){
            if(!empty($this->validators[$key])){
                $validator[$key] = $this->validators[$key];
            }
        }
        if(!empty($validator))
            return Validator::make($data,$validator);
        return false;
    }
}
