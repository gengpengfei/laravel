<?php

namespace App\Http\Home\Controllers;

use App\Servers\PayServer;
use App\Servers\QrCodeServer;
use Illuminate\Http\Request;
use Mockery\Exception;

class PayController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
    }
    /*
     * params :微信扫码支付
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/26 11:30
     */
    public function weChatPayWeb(PayServer $payServer,QrCodeServer $qrCodeServer)
    {
        $order = [
            'out_trade_no' => time(),
            'total_fee' => '1', // **单位：分**
            'body' => 'test body - 测试',
        ];
        $config = [
            'notify_url'=>"laravel.dev/Home/Pay/weChatRespond"
        ];
        return $qrCodeServer->setFormat("svg")->setSize(100)->getCode($payServer->setConfig($config)->weChatScan($order)->code_url);
    }
    
    /*
     * params :微信支付成功回调
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/26 11:30
     */
    public function weChatRespond(PayServer $payServer)
    {
        $config = [];
        try{
            $data = $payServer->setConfig($config)->weChatVerify();
        } catch (Exception $e) {
             $e->getMessage();
        }
        return $payServer->weChatSuccess();
    }
    
    /*
     * params :微信订单查询
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/26 11:45
     */
    public function weChatFind(PayServer $payServer)
    {
        //-- $order 可以为订单 或者 订单数组
        $order="4200000056201801240005070497";
        try{
            $res = $payServer->weChatFind($order);
        } catch (Exception $e){
            $e->getMessage();
        }
        return $res;
    }
    /*
     * params :微信退款
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/26 12:00
     */
    public function weChatRefund(PayServer $payServer)
    {
        //-- $order 可以为订单 或者 订单数组
        $order="4200000056201801240005070497";
        try{
            $res = $payServer->weChatRefund($order);
        } catch (Exception $e){
            $e->getMessage();
        }
        return $res;
    }
}
