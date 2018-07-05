<?php
namespace App\Servers;

/**
    +----------------------------------------------------------
     * @explain 二维码生成服务类
    +----------------------------------------------------------
     * @access server
    +----------------------------------------------------------
     * @return 二维码图片
    +----------------------------------------------------------
     * @acter Mr.Geng
    +----------------------------------------------------------
**/
use SimpleSoftwareIO\QrCode\BaconQrCodeGenerator;

class QrCodeServer {

    public function __construct(BaconQrCodeGenerator $qrCode)
    {
        $this->qrCode = $qrCode;
    }

    /*
     * params :获取二维码
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/25 17:58
     */
    public function getCode($content,$path='')
    {
        if(empty($path))
            return $this->qrCode->generate($content);
        return $this->qrCode->generate($content,$path);
    }

    /*
     * params :设置二维码返回的格式
     * explain: svg png eps
     * authors:Mr.Geng
     * addTime:2018/1/25 17:39
     */
    public function setFormat($format="png")
    {
        $this->qrCode->format($format);
        return $this;
    }

    /*
     * params :设置二维码大小
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/25 17:50
     */
    public function setSize($size='')
    {
        $this->qrCode->size($size);
        return $this;
    }

    /*
     * params :设置颜色
     * explain:只认RBG格式
     * authors:Mr.Geng
     * addTime:2018/1/25 18:01
     */
    public function setColor($x,$y,$z)
    {
        $this->qrCode->color($x,$y,$z);
        return $this;
    }

    /*
     * params :设置背景颜色
     * explain:只认RBG格式
     * authors:Mr.Geng
     * addTime:2018/1/25 18:02
     */
    public function setBgColor($x,$y,$z)
    {
        $this->qrCode->backgroundColor($x,$y,$z);
        return $this;
    }

    /*
     * params :设置内边框
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/25 18:03
     */
    public function setMargin($px=0)
    {
        $this->qrCode->margin($px);
        return $this;
    }
    
    /*
     * params :设置容错率
     * explain: L 7% M	15% Q	25%  H	30%
     * authors:Mr.Geng
     * addTime:2018/1/25 18:04
     */
    public function setErrorCorrection($correction="H")
    {
        $this->qrCode->errorCorrection($correction);
        return $this;
    }
    
    /*
     * params :设置图片的返回字符编码
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/25 18:05
     */
    public function setEncoding($codimg="UTF-8")
    {
        $this->qrCode->encoding($codimg);
        return $this;
    }

    /*
     * params :添加logo
     * explain:$path 路径 $size logo 占用图片大小 $flag 是否是绝对路径
     * authors:Mr.Geng
     * addTime:2018/1/25 18:06
     */
    public function setLogo($path,$size="0.3",$flag=false)
    {
        $this->qrCode->merge($path,$size,$flag);
        return $this;
    }
}