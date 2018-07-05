<?php

namespace App\Http\Api\Controllers;

use App\Models\User;
use App\Notifications\InvoiceDatabase;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

/**
    +----------------------------------------------------------
     * @explain 通知类
    +----------------------------------------------------------
     * @access public
    +----------------------------------------------------------
     * @return 通知类
    +----------------------------------------------------------
     * @acter Mr.Geng
    +----------------------------------------------------------
**/
class InvoiceController extends Controller
{
    public function __construct()
    {

    }
    /*
     * params :设置数据库通知
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/29 17:05
     */
    public function createDateBase(Request $request)
    {
        //--  取得所有会员实例
        $users = User::all();
        $value = array("1234","4567");
        $when = Carbon::now()->addMinutes(1);
        foreach ($users as $user){
            $user->notify((new InvoiceDatabase($value))->onQueue('InvoiceDateBase')->delay($when));
        }
        return $this->returnJson('',"设置通知成功",'1');
    }
    /*
     * params :获得未读通知
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/29 17:08
     */
    public function getUnread(Request $request)
    {
        //-- 获取当前会员实例
        $user = $request->get('userInfo');
        $data = [];
        foreach ($user->unreadNotifications as $notification) {
            $data[] = $notification->data;
        }
        return $this->returnJson($data,"获取未读通知",'1');
    }
    /*
     * params :全部通知标记为已读
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/29 17:13
     */
    public function setRead(Request $request)
    {
        $user = $request->get('userInfo');
        $user->unreadNotifications->markAsRead();
        return $this->returnJson('',"标记为已读",'1');
    }
    /*
     * params :删除已读通知
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/29 17:19
     */
    public function delRead(Request $request)
    {
        $user = $request->get('userInfo');
        $user->notifications()->delete();
        return $this->returnJson('',"清除已读",'1');
    }
    
    /*
     * params :测试redis连接
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/29 17:59
     */
    public function setRedis()
    {
        Redis::set('name', 'Taylor');
        var_dump(Redis::get("name"));
    }
}
