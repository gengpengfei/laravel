<?php

namespace App\Http\Middleware;
/**
    +----------------------------------------------------------
     * @explain 设置权限范围的中间件
    +----------------------------------------------------------
     * @access 用于设置权限验证的有效范围
    +----------------------------------------------------------
     * @return class
    +----------------------------------------------------------
     * @acter Mr.Geng
    +----------------------------------------------------------
**/
use Silber\Bouncer\Bouncer;
use Closure;
class ScopeBouncer
{
    /**
     * The Bouncer instance.
     *
     * @var \Silber\Bouncer\Bouncer
     */
    protected $bouncer;

    /**
     * Constructor.
     *
     * @param \Silber\Bouncer\Bouncer  $bouncer
     */
    public function __construct(Bouncer $bouncer)
    {
        $this->bouncer = $bouncer;
    }

    public function handle($request, Closure $next)
    {
        //-- 此功能可以走通 (暂时不做开发)
//        $tenantId = $request->user()->account_id;
//        $this->bouncer->scope()->to($tenantId);
        return $next($request);
    }
}
