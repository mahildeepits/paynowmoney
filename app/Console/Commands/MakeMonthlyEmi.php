<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeMonthlyEmi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:monthly-emi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate monthly EMIs for paid users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting EMI generation...');
        
        $currentDate = \Carbon\Carbon::now();
        $monthStr = $currentDate->format('F Y');
        
        // Get only paid users
        $paidUsers = \App\Models\User::whereNotIn('member_id',['admin'])->where('is_paid', 1)->get();
        $count = 0;

        foreach ($paidUsers as $user) {
            $exists = \App\Models\Emi::where('user_id', $user->id)
                         ->where('month', $monthStr)
                         ->exists();
                         
            if (!$exists) {
                // Check limit of 16 EMIs
                $totalEmis = \App\Models\Emi::where('user_id', $user->id)->count();
                
                if ($totalEmis < 16) {
                    \App\Models\Emi::create([
                        'user_id' => $user->id,
                        'amount' => 1300, 
                        'month' => $monthStr,
                        'status' => 'submitted',
                        'paid_at' => now(),
                    ]);
                    $count++;
                }
            }
        }

        $this->info("Generated $count EMIs for $monthStr.");
    }
}
