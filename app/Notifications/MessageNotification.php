<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MessageNotification extends Notification
{
    use Queueable;
    public $employee;
    public $message;

    /**
     * Create a new notification instance.
     */
    public function __construct($employee,$message)
    {
        $this->employee = $employee;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    public function toArray($notifiable)
    {
        return [
            'employee_id'=>$this->employee->id,
            'employee_name'=>$this->employee->first_name,
            'message'=>$this->message,
        ];
    }
}
