<?php
namespace App\Servers;
use Yansongda\LaravelPay\Facades\Pay;

/**
    +----------------------------------------------------------
     * @explain 支付服务类
    +----------------------------------------------------------
     * @access public
    +----------------------------------------------------------
     * @return 支付宝 微信 手机 web 等支付服务
    +----------------------------------------------------------
     * @acter Mr.Geng
    +----------------------------------------------------------
**/

class PayServer{
    private $config;
    public function __construct(Pay $pay)
    {
        $this->pay = $pay;
    }
    /*
     * params :设置支付配置项
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/26 11:18
     */
    public function setConfig($config=[])
    {
        $this->config = $config;
        return $this;
    }
    /*
     * params :支付宝电脑端支付
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/26 10:24
     */
    public function aliPayWeb($order)
    {
        if(empty($order)) return false;
        return $this->pay->alipay($this->config)->web($order);
    }
    /*
     * params :支付宝webapp支付
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/26 10:24
     */
    public function aliPayWebApp($order)
    {
        if(empty($order)) return false;
        return $this->pay->alipay($this->config)->wap($order);
    }
    /*
     * params :支付宝app支付
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/26 10:24
     */
    public function aliPayApp($order)
    {
        if(empty($order)) return false;
        return $this->pay->alipay($this->config)->app($order);
    }
    /*
     * params :支付宝扫码支付
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/26 10:24
     */
    public function aliPayScan($order)
    {
        if(empty($order)) return false;
        return $this->pay->alipay($this->config)->scan($order);
    }
    /*
     * params :支付宝账户之前转账
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/26 10:24
     */
    public function aliPayTransfer($order)
    {
        if(empty($order)) return false;
        return $this->pay->alipay($this->config)->transfer($order);
    }
    /*
     * params :支付宝验证签名
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/26 11:35
     */
    public function aliPayVerify()
    {
        return $this->pay->alipay($this->config)->verify();
    }
    /*
     * params :支付成功
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/26 11:38
     */
    public function aliPaySuccess()
    {
        return $this->pay->alipay($this->config)->success();
    }
    /*
     * params :支付宝查询订单
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/26 11:44
     */
    public function aliPayFind($order)
    {
        return $this->pay->alipay($this->config)->find($order);
    }
    /*
     * params :微信订单退款
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/26 11:44
     */
    public function aliPayRefund($order)
    {
        return $this->pay->alipay($this->config)->refund($order);
    }
    /*
     * params :微信公众号支付
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/26 10:24
     */
    public function weChatMp($order)
    {
        if(empty($order)) return false;
        return $this->pay->wechat($this->config)->mp($order);
    }
    /*
     * params :微信小程序支付
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/26 10:24
     */
    public function weChatMiniApp($order)
    {
        if(empty($order)) return false;
        return $this->pay->wechat($this->config)->miniapp($order);
    }
    /*
     * params :微信H5支付
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/26 10:24
     */
    public function weChatWap($order)
    {
        if(empty($order)) return false;
        return $this->pay->wechat($this->config)->wap($order);
    }
    /*
     * params :微信扫码支付
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/26 10:24
     */
    public function weChatScan($order)
    {
        if(empty($order)) return false;
        return $this->pay->wechat($this->config)->scan($order);
    }
    /*
     * params :微信app支付
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/26 10:24
     */
    public function weChatApp($order)
    {
        if(empty($order)) return false;
        return $this->pay->wechat($this->config)->app($order);
    }
    /*
     * params :微信企业支付支付
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/26 10:24
     */
    public function weChatTransfer($order)
    {
        if(empty($order)) return false;
        return $this->pay->wechat($this->config)->transfer($order);
    }
    /*
     * params :微信红包支付
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/26 10:24
     */
    public function weChatRedPack($order)
    {
        if(empty($order)||empty($config)) return false;
        return $this->pay->wechat($this->config)->redpack($order);
    }
    /*
     * params :微信抢红包支付
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/26 10:24
     */
    public function weChatGroupRedPack($order)
    {
        if(empty($order)) return false;
        return $this->pay->wechat($this->config)->groupRedpack($order);
    }
    /*
     * params :微信验证签名
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/26 11:35
     */
    public function weChatVerify()
    {
        return $this->pay->wechat($this->config)->verify();
    }
    /*
     * params :支付成功
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/26 11:38
     */
    public function weChatSuccess()
    {
        return $this->pay->wechat($this->config)->success();
    }
    /*
     * params :微信查询订单
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/26 11:44
     */
    public function weChatFind($order)
    {
        return $this->pay->wechat($this->config)->find($order);
    }
    /*
     * params :微信订单退款
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/26 11:44
     */
    public function weChatRefund($order)
    {
        return $this->pay->wechat($this->config)->refund($order);
    }
}