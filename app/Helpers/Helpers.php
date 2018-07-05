<?php

/**
 * 返回可读性更好的文件尺寸
 */
function human_filesize($bytes, $decimals = 2)
{
    $size = ['B', 'kB', 'MB', 'GB', 'TB', 'PB'];
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) .@$size[$factor];
}

/**
 * 判断文件的MIME类型是否为图片
 */
function is_image($mimeType)
{
    return starts_with($mimeType, 'image/');
}
/*
 * params :文件夹日期生成规则
 * explain:
 * authors:Mr.Geng
 * addTime:2018/1/23 13:04
 */
function dateFile()
{
    switch (config('app.uploads.route')){
        case 'Y':
            return date('Y');
        case 'M':
            return date('Ym');
        case 'D':
            return date('Ymd');
        default:
            return time();
    }
}