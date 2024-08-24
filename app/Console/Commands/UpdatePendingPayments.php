<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Dormitorypayment;
use Log;
class UpdatePendingPayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-pending-payments';
    protected $description = 'Update of Pending Payments';
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
        $payments = Dormitorypayment::where('status',"Pending")->get();

        foreach ($payments as $payment) {
            $payment->totalAmount = $payment->totalAmount + 60 ;
            $payment->save();
        }
        Log::info('Payments command is running.');
        $this->info('Payments updated successfully.');

    }
}
