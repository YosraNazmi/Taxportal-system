<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserApprovedNotification extends Notification
{
    use Queueable;
    public $approvalType;

    /**
     * Create a new notification instance.
     */
    public function __construct($approvalType)
    {
        //
        $this->approvalType = $approvalType;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->greeting('Hello ' . $notifiable->name . '!')
        ->line('Congratulations! Your account has been Reviewed.')
        ->line('your account is assigned to '. $this->approvalType . '.')
        ->line('Please visit the portal to login to your Tax Account ')
        ->action('Visit Portal', url('/login'))
        ->line('Thank you for using our application!');
    }
    

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
