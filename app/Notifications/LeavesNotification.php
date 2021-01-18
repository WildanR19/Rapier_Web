<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LeavesNotification extends Notification
{
    use Queueable;
    private $leaveData;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($leaveData)
    {
        $this->leaveData = $leaveData;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
        return [
           'leave_id' => $this->leaveData['leave_id'],
           'notification_type'  => $this->leaveData['type'],
           'user'               => $this->leaveData['username'],
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    // public function toArray($notifiable)
    // {
    //     return [
    //         'name'  => $this->user->name,
    //         'email' => $this->user->email,
    //     ];
    // }
}
