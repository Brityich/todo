<?php

namespace App\Console;

use App\Mail\EndtimeNotice;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->call(function () {
            $alltasks = DB::table('task')->get()->toArray();
            $timealarm = time() + (60 * 60);
            $task_endtime = [];
            foreach ($alltasks as $task) {
                var_dump($timealarm);
                var_dump(strtotime($task->time));
                if((strtotime($task->time) <= $timealarm) && (strtotime($task->time) >= ($timealarm - 60*5) )) {
                    $task_endtime[] = $task;
                }
            }
            foreach($task_endtime as $task) {
                $user = DB::table('users')
                    ->where('id', '=', $task->user)
                    ->first();
                /*$data = [
                    'user' => $user,
                    'task' => $task
                ];*/
                Mail::to($user)->send(new EndtimeNotice($task, $user));
            }
        })->everyFiveMinutes();
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
