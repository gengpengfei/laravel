<?php

namespace App\Http\Home\Controllers\Auth;

use App\Models\User;
use App\Http\Home\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

   /*
    * params : 重写创建用户方法
    * explain: 该方法暂未实现 (不可用)
    * authors:Mr.Geng
    * addTime:2018/2/7 14:13
    */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['name'],
            'mobile' => $data['mobile'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
