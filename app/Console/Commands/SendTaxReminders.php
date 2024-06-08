<?php

namespace App\Console\Commands;
use App\Models\Form;
use App\Models\User;
use Illuminate\Console\Command;
use App\Notifications\TaxReminderNotification;

class SendTaxReminders extends Command
{
    protected $signature = 'app:send-tax-reminders';

    protected $description = 'Send tax reminders to taxpayers.';

    public function handle()
    {
        $deadline = now()->addDays(5);

        // Retrieve taxpayers with upcoming tax deadlines
        $users = User::whereHas('forms', function ($query) use ($deadline) {
            $query->where('seasontoDate', '<=', $deadline);
        })->get();

        // Send reminders to each taxpayer
        foreach ($users as $user) {
            $user->notify(new TaxReminderNotification($user));
        }

        $this->info('Tax reminders sent successfully.');
    }
}