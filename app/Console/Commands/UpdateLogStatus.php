<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ResidentLog;
use Carbon\Carbon;
use Log;
class UpdateLogStatus extends Command
{
    protected $signature = 'logs:update-status';
    protected $description = 'Update status of resident logs';

    public function handle()
    {
        $ldate = date('Y-m-d H:i:s');
        $logs = ResidentLog::whereNull('return_date')->get();

        foreach ($logs as $log) {
            $log->status = 'Failed';
            $log->save();
        }
        Log::info('UpdateLogStatus command is running.');
        $this->info('Log statuses updated successfully.');
    }
}
