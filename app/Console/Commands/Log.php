<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Log extends Command
{
    /**
     * 控制台命令 和 签名
     * 类似于计划任务的名称
     * @var string
     */
    protected $signature = 'command:Log';

    /**
     * 控制台命令显示的描述
     *
     * @var string
     */
    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 需要执行的计划任务(可以写任何的可执行逻辑)
     *
     * @return mixed
     */
    public function handle()
    {
        echo 123;
    }
}
