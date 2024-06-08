<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserRejectedNotification extends Notification
{
    use Queueable;
    
    public $comment; // Variable to hold the admin's comment

    /**
     * Create a new notification instance.
     *
     * @param string $comment The comment from the admin explaining the rejection.
     */
    public function __construct(string $comment)
    {
        $this->comment = $comment;
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
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Application Rejected')
            ->line('Sorry, we cannot approve your application at this time.')
            ->line('Reason: ' . $this->comment) // Include the admin's comment
            // Update URL to a specific route if necessary
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
