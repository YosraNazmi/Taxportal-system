<?php
namespace App\Notifications;
use App\Models\Taxpayer;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TaxReminderNotification extends Notification
{
    use Queueable;

    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Reminder: Your tax deadline is approaching.',
            'taxpayer_name' => $this->user->name,
            'submission_date' => $this->user->submission_date,
        ];
    }


}