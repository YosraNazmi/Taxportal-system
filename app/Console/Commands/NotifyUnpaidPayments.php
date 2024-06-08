<?php

namespace App\Console\Commands;

use App\Models\Payment;
use Illuminate\Console\Command;

class NotifyUnpaidPayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payments:notify-unpaid';

    protected $description = 'Notify users of unpaid payments five days before the deadline';

    /**
     * The console command description.
     *
     * @var string
     */
   

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        // Find payments due within five days from now
        $fiveDaysFromNow = now()->addDays(5);
        $payments = Payment::where('payment_deadline', '<=', $fiveDaysFromNow)
            ->whereNull('paid_at')
            ->get();

        // Send notifications to users
        foreach ($payments as $payment) {
            $user = $payment->form->user;
            // Send notification to $user
            // Example: $user->notify(new UnpaidPaymentNotification($payment));
        }
    }
    
}
