<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Laundryschedule;
use App\Models\User;

use Carbon\Carbon;
class UpdateLaundrySchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-laundry-schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $yesterday = Carbon::now()->subDays(1)->format('Y-m-d');
        $schedules = Laundryschedule::where('laundrydate', $yesterday)->get();
        foreach($schedules as $schedule){
            $user = User::findOrFail($schedule->user_id);
            $user->is_scheduled = 0;
            $user->save();
        }
    }
}
