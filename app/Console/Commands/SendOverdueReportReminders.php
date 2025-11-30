<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendOverdueReportReminders extends Command
{
    protected function schedule(Schedule $schedule)
{
    $schedule->command('reports:send-overdue-reminders')->dailyAt('08:00');
}
/**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-overdue-report-reminders';

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
    }
}
