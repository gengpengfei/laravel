<?php
namespace App\Jobs;

use App\Models\Ad;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
/**
+----------------------------------------------------------
 * @explain 队列任务类
+----------------------------------------------------------
 * @access 该队列用于创建订单 , 队列名称 "createOrder"
+----------------------------------------------------------
 * @return
+----------------------------------------------------------
 * @acter Mr.Geng
+----------------------------------------------------------
 **/
class CreateOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    //--  需要入队的任务实例
    protected $ad;
    //--  一个任务的失败重试次数
    public $tries = 5;
    //--  一个任务的最长执行时间
    public $timeout = 120;
    /*
     * params :这里接收并创建新的任务实例
     * explain:
     * authors:Mr.Geng
     * addTime:2018/1/29 11:13
     */
    public function __construct($ad)
    {
        $this->ad = $ad;
    }

    /*
     * params :执行出队任务
     * explain:实例化时 , 会自动执行该方法
     * authors:Mr.Geng
     * addTime:2018/1/29 10:59
     */
    public function handle()
    {
        sleep(5);
        Ad::create($this->ad);
    }
    /*
     * params :失败的队列
     * explain:失败的队列会自动执行此方法
     * authors:Mr.Geng
     * addTime:2018/1/30 9:50
     */
    public function failed(Exception $e)
    {
        // 发送失败通知, etc...
        return $e->getMessage();
    }
}
