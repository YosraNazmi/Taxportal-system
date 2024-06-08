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
            'message' => 'A manager has rejected a user application that requires your attention.',
            'user_name' => $this->user->name,
            'reason' => $this->comment
        ];
    }
}

