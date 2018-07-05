<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
/**
    +----------------------------------------------------------
     * @explain 数据库通知
    +----------------------------------------------------------
     * @access 会在数据库 notifications 表里面存数据 用于从后台向用户发送集体通知
    +----------------------------------------------------------
     * @return class
    +----------------------------------------------------------
     * @acter Mr.Geng
    +----------------------------------------------------------
**/
class InvoiceDatabase extends Notification implements ShouldQueue
{
    use Queueable;
    protected $invoice;

    public function __construct($invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * 设置通知的选择渠道
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }
    /**
     * 设置通知的内容
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase ($notifiable)
    {
        sleep(10);
        return $this->invoice;
    }
}
