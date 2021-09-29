<?php

namespace App\Console\Commands;

use Mail;
use DB;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Console\Command;

class HolidayCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'holiday:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send bank holiday mail';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        \Log::info("Holiday Cron is working fine!");

        $sql5="SELECT holiday_name, start_date , DATEDIFF(end_date,start_date) as nombre FROM `bank_holiday` where DATEDIFF(start_date,CURDATE())=4 order by holiday_name ASC limit 1";
        $emailjr=DB::select(DB::raw($sql5));
        $sql="SELECT * from users ";
        $users = DB::select(DB::raw($sql));
        if(count($emailjr)){
            for($i=0;$i<count($users);$i++)
            {
                $start=$emailjr[0]->start_date;
                $nombre=$emailjr[0]->nombre;
                $name=$users[$i]->firstname ." ".$users[$i]->lastname;
                $email=$users[$i]->email;
                $data = array('name'=>$name, "body" => 'On the occasion of the feast : '.$emailjr[0]->holiday_name.', we remind you that our business will be celebrating this day, so we will be out of office  for '.$nombre .' days , Enjoy!!');
                Mail::send('emails', $data, function($message) use ($name,$email ) {
                    $message->to($email, $name)->subject('Wave HR> Happy reminder: We\'ll be closed for Bank holidays');
                    $message->from(config('mail.from.address'),'Wave HR Team');
                });
            }
        }
        $this->info('holiday:Cron Cummand Run successfully!');
    }
}
