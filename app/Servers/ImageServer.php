<?php

namespace App\Servers;

/**
 * +----------------------------------------------------------
 * @explain 图像处理服务类
 * +----------------------------------------------------------
 * @access server
 * +----------------------------------------------------------
 * @return 裁切 缩放 压缩 图像处理 颜色处理 缓存 等
 * +----------------------------------------------------------
 * @acter Mr.Geng
 * +----------------------------------------------------------
 **/
use Intervention\Image\ImageManagerStatic as Image;

class ImageServer
{
    //-- 图片源 --//
    protected $img;
    //-- 缓存有效时间 --//
    protected $lifetime;
    //-- 是否返回图像流 --//
    protected $returnObj = true;
    //-- 图片路径 --//
    protected $imgSource;
    //-- 图片名称 --//
    protected $imgName;
    //-- 压缩图片时是否保持图片质量 --//
    private $resizeFlag;
    //-- 宽高比 --//
    private $aspectRatio;
    //-- 图片宽度 --//
    private $width;
    //-- 图片高度 --//
    private $height;
    //-- 画线的颜色 --//
    private $lineColor;
    //-- 文本样式 --//
    private $fontStyle;

    public function __construct(UploadsServer $uploadsServer)
    {
        $this->lifetime = config('image.lifetime') ?: 43200;
        $this->uploadsServer = $uploadsServer;
    }

    /*
     * params :设置图片url
     * explain:同时缓存图片
     * authors:Mr.Geng
     * addTime:2018/1/24 14:53
     */
    public function setImg($url)
    {
        $this->imgSource = $url;
        $this->img = Image::cache(function ($image) {
            $image->make($this->imgSource);
        }, $this->lifetime, $this->returnObj);
        return $this;
    }

    /*
     * params :设置图像当前宽高
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/25 14:11
     */
    protected function setWH($width, $height)
    {
        $this->width = intval($width);
        $height ? $this->height = intval($height) : $this->height = intval($this->getAspectRatio() * $width);
    }

    /*
     * params :获取当前图像宽
     * explain:若当前图像未做缩放 , 取原图大小
     * authors:Mr.Geng
     * addTime:2018/1/25 14:13
     */
    public function getWidth()
    {
        return $this->width ?: $this->img->width();
    }

    /*
     * params :获取当前图像高
     * explain:若当前图像未做缩放 , 取原图大小
     * authors:Mr.Geng
     * addTime:2018/1/25 14:13
     */
    public function getHeight()
    {
        return $this->height ?: $this->img->height();
    }

    /*
     * params :直接返回图片到http
     * explain: http 返回 $type 返回格式
     * authors:Mr.Geng
     * addTime:2018/1/24 15:46
     */
    public function responseImg($type = '')
    {
        return $this->img->response($type);
    }

    /*
     * params :获取图片大小
     * explain:只有真实的图片可以读取大小 , 否则返回false
     * authors:Mr.Geng
     * addTime:2018/1/25 14:44
     */
    public function getSize()
    {
        return $this->img->filesize();
    }

    /*
     * params :另存为图片
     * explain: $name 为空读取原图路径替换 , 或者保存到other里面
     * authors:Mr.Geng
     * addTime:2018/1/24 14:53
     */
    public function saveImg($name = '')
    {
        $name ? $this->imgName = $name : $this->imgName = $this->setImgName();
        return $this->img->save($this->imgName);
    }

    /*
     * params :生成图片名称和路径
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/24 18:33
     */
    protected function setImgName()
    {
        return dirname($this->imgSource) . "/" . basename($this->imgSource) ?: $this->setUploadDir();
    }

    /*
     * params :设置图片默认路径
     * explain:当获取不到路径时
     * authors:Mr.Geng
     * addTime:2018/1/24 19:43
     */
    protected function setUploadDir()
    {
        $uploadDir = "/other/" . dateFile() . "/";
        $this->uploadsServer->createDirectory($uploadDir);
        return "./uploads" . $uploadDir . uniqid() . $this->getMime();
    }

    /*
     * params : 返回图片类型
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/24 19:06
     */
    public function getMime()
    {
        $mime = $this->img->mime();
        switch ($mime) {
            case "image/gif":
                return ".gif";
            case "image/jpeg":
                return ".jpeg";
            case "image/png":
                return ".png";
            case "image/bmp":
                return ".bmp";
            case "image/pjpeg":
                return ".jpeg";
            case "image/x-png":
                return ".png";
            default:
                return '.jpg';
        }
    }

    /*
     * params :返回图像流
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/25 9:33
     */
    public function getStream()
    {
        return $this->img->stream();
    }

    /*
     * params :按格式和质量进行图像编码
     * explain: $type 可选 jpg、png、gif、tif、bmp、data-url(base64)。默认类型是 'jpeg', $quality 图片质量 0-100
     * authors:Mr.Geng
     * addTime:2018/1/25 9:49
     */
    public function getEncode($type = '', $quality = 100)
    {
        return $this->img->encode($type, $quality);
    }

    /*
     * params :销毁图片对象
     * explain: 返回空的Intervention\Image对象
     * authors:Mr.Geng
     * addTime:2018/1/25 9:54
     */
    public function destroy()
    {
        return $this->img->destroy();
    }

    /*
     * params :返回原生GD对象已使用原生函数
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/25 9:55
     */
    public function getCore()
    {
        return $this->img->getCore();
    }

    /*
     * params :图像镜像
     * explain:默认h-水平 v-垂直 镜像
     * authors:Mr.Geng
     * addTime:2018/1/25 9:57
     */
    public function setFlip($type = 'h')
    {
        $this->img->flip($type);
        return $this;
    }

    /*
     * params :图像旋转
     * explain:逆时针旋转 $angle 度 , 未覆盖部分背景 $bg
     * authors:Mr.Geng
     * addTime:2018/1/25 9:57
     */
    public function setRotate($angle = "90", $bg = "#fff")
    {
        $this->img->rotate($angle, $bg);
        return $this;
    }

    /*
     * params :图像缩放
     * explain:无参数取默认宽度,并保持宽高比
     * authors:Mr.Geng
     * addTime:2018/1/25 11:52
     */
    public function setResize($width, $height = '', $flag = "true")
    {
        $this->resizeFlag = $flag;
        $this->setWH($width, $height);
        $this->img->resize($this->width, $height ?: $this->height, function ($constraint) {
            $constraint->aspectRatio();
            $this->resizeFlag ? $constraint->upsize() : '';
        });
        return $this;
    }

    /*
     * params :图像裁切
     * explain:不设置订点默认左上角开始
     * authors:Mr.Geng
     * addTime:2018/1/25 11:58
     */
    public function setCrop($width, $height = '', $x = 0, $y = 0)
    {
        $this->setWH($width, $height);
        $this->img->crop($this->width, $this->height, $x, $y);
        return $this;
    }

    /*
     * params :调整图像大小
     * explain:压缩宽高默认从中心压缩,未设置高度,按宽高比缩放
     * authors:Mr.Geng
     * addTime:2018/1/25 12:46
     */
    public function setCanvas($width, $height = '', $x = "center")
    {
        $this->setWH($width, $height);
        $this->img->resizeCanvas($this->width, $this->height, $x);
        return $this;
    }

    /*
     * params :获得源图片的当前宽高比
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/25 14:27
     */
    protected function getAspectRatio()
    {
        $imgWidth = $this->img->width();
        $imgHeight = $this->img->height();
        return $this->aspectRatio = $imgHeight / $imgWidth;
    }

    /*
     * params :改变图片亮度
     * explain: $level -100 到 +100 范围
     * authors:Mr.Geng
     * addTime:2018/1/25 14:29
     */
    public function setBrightness($level = 0)
    {
        $this->img->brightness($level);
        return $this;
    }

    /*
     * params :反转图片的颜色
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/25 14:34
     */
    public function setInvert()
    {
        $this->img->invert();
        return $this;
    }

    /*
     * params :清除图片的颜色
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/25 14:34
     */
    public function setGreyscale()
    {
        $this->img->greyscale();
        return $this;
    }

    /*
     * params :设置马赛克
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/25 14:42
     */
    public function setPixelate($level = 0)
    {
        $this->img->pixelate($level);
        return $this;
    }

    /*
     * params :在图像上画点
     * explain: $color 颜色, $x $y 坐标
     * authors:Mr.Geng
     * addTime:2018/1/25 14:51
     */
    public function setPixel($color, $x, $y)
    {
        $this->img->pixel($color, $x, $y);
        return $this;
    }

    /*
     * params :在图像上画线
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/25 14:53
     */
    public function setLine($x, $y, $ex, $ey, $bgColor = "#fff")
    {
        $this->lineColor = $bgColor;
        $this->img->line($x, $y, $ex, $ey, function ($constraint) {
            $constraint->color($this->lineColor);
        });
        return $this;
    }

    /*
     * params :在图像插入文本
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/25 14:58
     */
    public function setText($text, $x = 0, $y = 0, $fontStyle = [])
    {
        $this->fontStyle = $fontStyle;
        $this->img->text($text, $x, $y, function ($constraint) {
            //- 设置True Type Font文件的路径 或者GD库内部字体之一的1到5之间的整数值
            $constraint->file(empty($this->fontStyle['fontFamily'])? 1:$this->fontStyle['fontFamily']);
            $constraint->size(empty($this->fontStyle['fontSize'])? 12:$this->fontStyle['fontSize']);
            $constraint->color(empty($this->fontStyle['fontColor'])? "#fff":$this->fontStyle['fontColor']);
            //- 水平对齐方式：left,right,center。默认left
            $constraint->align(empty($this->fontStyle['fontAlign'])? "left":$this->fontStyle['fontAlign']);
            //- 垂直对齐方式：top,bottom,middle。默认bottom
            $constraint->valign(empty($this->fontStyle['fontJustify'])? "bottom":$this->fontStyle['fontJustify']);
            //- 文本旋转角度。文本将围绕垂直和水平对齐点逆时针旋转。 旋转仅在设置字体文件时可用，否则将被忽略
            $constraint->angle(empty($this->fontStyle['fontRotar'])? "0":$this->fontStyle['fontRotar']);
        });
        return $this;
    }

    /*
     * params :给图片添加水印
     * explain:$url 源文件 $align
     * authors:Mr.Geng
     * addTime:2018/1/25 15:40
     */
    public function setMark($url,$x=0,$y=0,$align="top-left")
    {
        $this->img->insert($url,$align,$x,$y);
        return $this;
    }
}