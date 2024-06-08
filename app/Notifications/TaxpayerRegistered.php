<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaxpayerRegistered extends Notification
{
    use Queueable;

    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['database']; // Adjust based on your needs, could include 'mail'
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'New User Registration',
            'message' => "A new user, {$this->user->firstname} {$this->user->lastname}, has just registered.",
            'user_id' => $this->user->id
        ];
    }
}
