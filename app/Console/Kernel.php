<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Admin;
use App\Models\Contract;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ContractExpired;
class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $month = now()->addMonth()->format('m');
            $year = now()->addMonth()->format('Y');
            $contract = Contract::whereMonth('time_end', '=', $month)->whereYear('time_end', '=', $year)
            ->with(['room' => function($query){
                $query->select('id', 'building_id');
                $query->with(['building' => function($query){
                    $query->select('id', 'admin_id');
                    $query->with(['admin']);
                }]);
            }])->get();
            foreach ($contract as $item) {
                $admin = $item->room->building->admin;
                Notification::send($admin, new ContractExpired($item));
            }

        })->monthly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
