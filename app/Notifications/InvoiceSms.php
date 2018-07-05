<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\NexmoMessage;
/**
    +----------------------------------------------------------
     * @explain Nexmo 短信通知
    +----------------------------------------------------------
     * @access public
    +----------------------------------------------------------
     * @return Nexmo 短信通知
    +----------------------------------------------------------
     * @acter Mr.Geng
    +----------------------------------------------------------
**/
class InvoiceSms extends Notification
{
    use Queueable;
    protected $invoice;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * 获取通知的交付通道
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['nexmo'];
    }

    /**
     * Get the Nexmo / SMS representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return NexmoMessage
     */
    public function toNexmo($notifiable)
    {
        return (new NexmoMessage)
            ->content('Your SMS message content')
            ->unicode();
    }
}
