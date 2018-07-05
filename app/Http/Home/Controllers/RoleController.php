<?php
namespace App\Http\Home\Controllers;

use App\Models\Ad;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Silber\Bouncer\Bouncer;

class RoleController extends Controller{
    public function setRole(Bouncer $bouncer)
    {
        $user = Auth::user();
        //-- 创建 admin 分组 并设置orderList 权限
//        $bouncer->allow('operating')->to('order');

        //--  创建分组
//        $admin = $bouncer->role()->create([
//            'name' => 'admin',
//            'title' => '超级管理员',
//        ]);
        //--  创建权限
//        $ban = $bouncer->ability()->create([
//            'name' => 'adManage',
//            'title' => '商品管理',
//        ]);
        //--  分组绑定权限
//        $bouncer->allow($admin)->to($ban);

        //--  设置用户分组
//        $bouncer->assign('admin')->to($user);
//        $user->assign('admin');

        //--  设置用户权限
//        $bouncer->allow($user)->to('adManage');
//        $user->allow('adManage');

        //-- 移除用户分组
//        $bouncer->retract('admin')->from($user);
//        $user->retract("admin");

        //-- 移除用户权限
//        $user->disallow('admin');
//        $bouncer->disallow($user)->to('adManage');

        //-- 设置用户模型权限
//        $bouncer->allow($user)->to('view', Ad::class ,['name'=>'view','title'=>"视图管理"]);
        //-- 移除模型权限
//        $bouncer->disallow($user)->to('view',Ad::class);
        //--  禁止用户权限
//        $bouncer->forbid($user)->to('view', Ad::class);
        //--  移除禁止权限
//        $bouncer->unforbid($user)->to('view', Ad::class);


        //--  给admin分组所有权限
//        $bouncer->allow('admin')->everything();
        //--  禁止admin分组管理用户的权限
//        $bouncer->forbid('admin')->toManage(User::class);

        //--  只允许一个用户管理ad模型
//        $bouncer->allow($user)->toOwn(User::class,['name'=>'editUser','title'=>"用户管理"]);
        //--  移除
//        $bouncer->disallow($user)->toOwn(User::class,['name'=>'editUser','title'=>"用户管理"]);
        //--  只允许一个用户管理所有模型
//        $bouncer->allow($user)->toOwnEverything();

        //--  检查用户角色是否绑定分组
//        $bouncer->is($user)->an('admin');
//        $user->isAn('admin');
        //--  检查用户角色是否未绑定分组
//        $bouncer->is($user)->notAn('admin');
//        $user->isNotAn('operating');
        //-- 检查用户是否拥有以下所有分组
//        $bouncer->is($user)->all('admin', 'operating');
//        $user->isAll('admin', 'operating');

        //-- 检查用户是否有此权限
//        $user->can('adManage');
//        $user->cannot('adManage');
        //--  检查权限表中是否有此权限
//        $bouncer->can('adManage');
//        $bouncer->cannot('adManage');

        //-- 模板指令
//        @can ('update', $post)
//            <a href="{{ route('post.update', $post) }}">Edit Post</a>
//        @endcan
//        @if ($user->isAn('admin'))
        //
//        @endif

        //-- 设置和清除缓存
//        $bouncer->cache();
//        $bouncer->dontCache();
        //-- 刷新缓存
//        $bouncer->refresh();
//        $bouncer->refreshFor($user);
    }
}