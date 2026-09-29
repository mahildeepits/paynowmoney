<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\UserRdEmi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class SendRdEmiReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rd:emi-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminders for pending RD EMIs 3 days and 1 day before due date';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $pendingEmis = UserRdEmi::with('user')->where('status', 'pending')->get();

        foreach ($pendingEmis as $emi) {
            $dueDate = Carbon::parse($emi->due_date);
            
            if (Carbon::now()->addDays(3)->isSameDay($dueDate)) {
                // Send 3-day reminder
                Log::info("Reminder: 3 days left for RD EMI ID {$emi->id} for User {$emi->user->name}");
            }

            if (Carbon::now()->addDays(1)->isSameDay($dueDate)) {
                // Send 1-day reminder
                Log::info("Reminder: 1 day left for RD EMI ID {$emi->id} for User {$emi->user->name}");
            }
        }

        $this->info('RD EMI reminders processed.');
    }
}
