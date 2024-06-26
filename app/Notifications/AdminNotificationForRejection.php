<?php

namespace App\Notifications;
use Illuminate\Notifications\Notification;

class AdminNotificationForRejection extends Notification
{
    public $user;
    public $comment;

    public function __construct($user, $comment)
    {
        $this->user = $user;
        $this->comment = $comment;
    }

    public function via($notifiable)
    {
        return ['database'];  // Define which channels the notification will be sent to
    }

    public function toArray($notifiable)
    {
        return [
            'user_name' => $this->user->firstname . ' ' . $this->user->lastname,
            'message' => 'A user has been rejected.',
            'reason' => 'Some reason',
            'url' => route('rejectedUser') // Add the route for the rejected user page
        ];

        
    }
}

