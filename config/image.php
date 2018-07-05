<?php
/**
    +----------------------------------------------------------
     * @explain 图片处理配置
    +----------------------------------------------------------
     * @access public
    +----------------------------------------------------------
     * @return 图片处理配置
    +----------------------------------------------------------
     * @acter Mr.Geng
    +----------------------------------------------------------
**/
return [

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
    */

    'driver' => 'gd',
    'lifetime'=> "43200",//--图片缓存时间
];
