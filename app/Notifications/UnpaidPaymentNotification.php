<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Payment;

class UnpaidPaymentNotification extends Notification
{
    use Queueable;

    protected $payment;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Reminder: Unpaid Payment')
            ->line('You have an unpaid payment due soon.')
            ->line('Payment Reference: ' . $this->payment->form_reference)
            ->line('Amount Due: $' . $this->payment->dueTax)
            ->line('Deadline: ' . $this->payment->payment_deadline->format('Y-m-d H:i:s'))
            ->action('Pay Now', url('/payments/' . $this->payment->id))
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            // Convert the notification to an array if needed
        ];
    }
}
