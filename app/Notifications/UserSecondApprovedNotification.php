<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserSecondApprovedNotification extends Notification
{
    use Queueable;

    protected $user;
    protected $comment;

    public function __construct($user, $comment)
    {
        $this->user = $user;
        $this->comment = $comment;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'user_name' => $this->user->firstname . ' ' . $this->user->lastname,
            'message' => 'A user has been approved and is pending further review.',
            'comment' => $this->comment,
            'url' => route('review-pending-users') // Add the route for the review pending users page
        ];
    }
}
