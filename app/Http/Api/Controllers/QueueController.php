<?php
namespace App\Http\Api\Controllers;
use App\Jobs\CreateOrder;
use Illuminate\Http\Request;

/**
    +----------------------------------------------------------
     * @explain 使用队列控制器类
    +----------------------------------------------------------
     * @access class
    +----------------------------------------------------------
     * @return 使用队列
    +----------------------------------------------------------
     * @acter Mr.Geng
    +----------------------------------------------------------
**/
class QueueController extends Controller{

    /*
     * params :使用队列插入一条数据
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/29 11:04
     */
    public function createOrder(Request $request)
    {
        $job = (new CreateOrder($request->all()))->onQueue('create');
        dispatch($job);
        return $this->returnJson('',"入队成功",'1');
    }
}