<?php
namespace App\Listeners;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\Storage;
/**
    +----------------------------------------------------------
     * @explain 数据库执行监听类
    +----------------------------------------------------------
     * @access 用来监听数据库执行语句和时间
    +----------------------------------------------------------
     * @return class
    +----------------------------------------------------------
     * @acter Mr.Geng
    +----------------------------------------------------------
**/
class SqlListen {

    public function __construct() {

    }

    /*
     * explain: 监听QueryExecuted服务
     * authors:Mr.Geng
     * addTime:2017/12/20 17:27
     */
    public function handle(QueryExecuted $event) {
        $time = $event->time;
        $html = "执行时间:".date('Y-m-d H:i:s')."\r\n"."Sql语句:".json_encode($event->sql)."\r\n"."Sql参数:".json_encode($event->bindings)."\r\n"."Sql时间:".$time."\r\n";
        $logfilename=date('Y-m-d');
        config(['filesystems.default' =>'storage']);
        Storage::append("/logs/SqlListen/$logfilename.txt",$html);
        config(['filesystems.default' =>'local']);
    }
}