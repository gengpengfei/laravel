<?php

namespace App\Providers;

use Encore\Admin\Config\Config;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

//-- 内核启动操作会依次执行所有服务提供者的register函数，全部注册完成之后，才执行boot函数
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //--  自动加载后台配置项
        Config::load();
    }

    /**
     * Register any application services.
     * 
     * @return void
     */
    public function register()
    {
        //
    }
}
