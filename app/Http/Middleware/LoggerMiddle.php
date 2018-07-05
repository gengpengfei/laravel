<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;
use Illuminate\Log\Writer;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Mockery\Exception;
use Monolog\Logger;

class LoggerMiddle
{
    // 所有的LOG都要求在这里注册
    const LOG_ERROR = 'error';
    private static $loggers = array();

    // 获取一个实例
    public static function getLogger($type = self::LOG_ERROR, $day = 30)
    {
        if (empty(self::$loggers[$type])) {
            self::$loggers[$type] = new Writer(new Logger($type));
            self::$loggers[$type]->useDailyFiles(storage_path().'/logs/'. $type .'.log', $day);
        }
        $log = self::$loggers[$type];
        return $log;
    }

    public function DbListen()
    {

    }
}
