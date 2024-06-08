<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OverSlaNotification extends Notification
{
    use Queueable;
    protected $customersData;
    protected $overSlaCount;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($customersData, $overSlaCount)
    {
        $this->customersData = $customersData;
        $this->overSlaCount = $overSlaCount;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // return (new MailMessage)
        //             ->subject('Customer SLA Notification')
        //             ->line('รหัสลูกค้า: ' . $this->customer->cus_no)
        //             ->line('ลูกค้า: ' . $this->customer->cus_name)
        //             // ->line('ลักษณะงาน: ' . $this->customer->notify_ref->name)
        //             ->line('สถานะงาน: ' . $this->customer->status)
        //             ->line('Days passed: ' . $this->dayDiff)
        //             ->line('ผู้เกี่ยวข้องโปรดดำเนินการ');
        return (new MailMessage)
                    ->subject('Customer SLA Notification')
                    ->view('notify.email',  [
                        'customersData' => $this->customersData,
                        // 'overSlaCount' => $this->overSlaCount,
                    ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
