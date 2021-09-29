<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use DB;
use Carbon\Carbon;
use App\Models\User;
class BalanceIncrementCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'increment:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Increment users balances';

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
        \Log::info("Cron is working fine!");
        $sql1="UPDATE users SET balance = balance+1.5 where statut=1";
        $balances = DB::update(DB::raw($sql1));
        $sql="SELECT * from users where admin= 1";
        $admins = DB::select(DB::raw($sql));
        if($balances){
            for($i=0;$i<count($admins);$i++)
            {
                $name=$admins[$i]->firstname ." ".$admins[$i]->lastname;
                $email=$admins[$i]->email;
                $data = array('name'=>$name, "body" => 'All user balances have been updated successfully');
                Mail::send('emails', $data, function($message) use ($name,$email ) {
                    $message->to($email, $name)->subject('Wave HR> Balance updated.');
                    $message->from(config('mail.from.address'),'Wave HR Team');
                });
            }
        }
        $this->info('Demo:Cron Cummand Run successfully!');
    }
}
