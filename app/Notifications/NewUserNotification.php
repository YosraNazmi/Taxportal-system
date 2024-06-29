<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewUserNotification extends Notification
{
    use Queueable;


    public $user;
    

    public function __construct($user)
    {
        $this->user = $user;
 
    }

    public function via($notifiable)
    {
        return ['database'];  // Define which channels the notification will be sent to
    }

    public function toArray($notifiable)
    {
        return [
            'user_name' => $this->user->firstname . ' ' . $this->user->lastname,
            'message' => 'A new user has registered.',
            'reason' => null,
            'url' => route('review-pending-users') // Add the route for the new user page
        ];
    }
}
