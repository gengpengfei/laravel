<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /*
     * explain: 监听服务
     * authors:Mr.Geng
     * addTime:2017/12/20 17:23
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
        // 用于监听QueryExecuted
        'Illuminate\Database\Events\QueryExecuted' => [
            'App\Listeners\SqlListen',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        //
    }
}
