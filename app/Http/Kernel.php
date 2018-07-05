<?php

namespace App\Http;

use App\Http\Middleware\ApiAuthenticate;
use App\Http\Middleware\LoggerMiddle;
use App\Http\Middleware\ValidatorMiddle;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
/**
    +----------------------------------------------------------
     * @explain 中间件组和自定义中间件配置
    +----------------------------------------------------------
     * @access public
    +----------------------------------------------------------
     * @return 中间件组和自定义中间件配置
    +----------------------------------------------------------
     * @acter Mr.Geng
    +----------------------------------------------------------
**/
class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            //-- 表单验证中间件
            'ValidatorMiddle',
            //--  权限验证中间件
            \App\Http\Middleware\ScopeBouncer::class,
        ],

        'api' => [
            'ValidatorMiddle',
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        //--限制接口的调用频率
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        //--自定义passport 返回中间件
        'auth.api' => ApiAuthenticate::class,
        'ValidatorMiddle' => ValidatorMiddle::class,
    ];
}
