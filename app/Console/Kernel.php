<?php

namespace App\Console;
use DB;
use Carbon\Carbon;
use App\Models\Cron;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\BalanceIncrementCron::class,
        Commands\HolidayCron::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
      $sql="select date_execution from crons";
        $date=DB::select(DB::raw($sql));
        if(count($date)>0)
        {
            $jr = date("d",strtotime($date['0']->date_execution));
            $schedule->command('increment:cron')
                ->monthlyOn($jr, '00:00')
                ->runInBackground();
        }else{
            $schedule->command('increment:cron')
                ->monthlyOn(1, '00:00')
                ->runInBackground();
        }

        $schedule->command('holiday:cron')
            ->daily()
            ->runInBackground();
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
