<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Silber\Bouncer\Database\HasRolesAndAbilities;
class User extends Authenticatable
{
    use Notifiable,HasApiTokens,HasRolesAndAbilities;
    /*
     * explain:需要存储并且显示的字段
     * authors:Mr.Geng
     * addTime:2017/12/18 15:47
     */
    protected $fillable = [
        'username', 'password','mobile'
    ];

    /*
     * explain:隐藏字段
     * authors:Mr.Geng
     * addTime:2017/12/18 15:47
     */
    protected $hidden = [
        'password', 'remember_token','created_at','updated_at','id'
    ];
    /*
     * explain:重写passport验证字段方法
     * authors:Mr.Geng
     * addTime:2017/12/15 15:34
     */
    public function findForPassport($username)
    {
        return self::where('username', $username)->first();
    }
}
