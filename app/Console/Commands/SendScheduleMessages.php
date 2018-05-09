<?php

namespace App\Console\Commands;

use App\Jobs\SendMessage;
use App\Models\Contact;
use App\Models\ScheduleMessages;
use App\Models\Did;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendScheduleMessages extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SendScheduleMessages:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scheduled Messages';


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
     * @return mixed
     */
    public function handle()
    {
        $s_messages = ScheduleMessages::where('flag',1)
                            ->where('flagE',1)
                            ->get();
        foreach ($s_messages as $message) {
            /**
             * @var $did Did
             */
            $is = 0;
            $startTime = new Carbon($message->start_time);
            $endTime = new Carbon($message->end_time);
            $currentTime = new Carbon;
            $lastDate = new Carbon($message->last_date);
            if( ($startTime->diff(new Carbon)->format('%R') == '+') && ($currentTime->diff($endTime)->format('%R') == '+') ) {

                
                if($lastDate->day != $currentTime->day)
                    $is = 1;
            }
            // time correct another day
            if($is == 1){
                
                $flag = 0;
                if($message->frequency == 'daily') {
                    if($message->repeat == -1) { //on Date
                        $endDate = new Carbon($message->repeat_end);
                        if( $endDate->diff(new Carbon)->format('%R') == '+' ) {
                            ScheduleMessages::find('id',$message->id)->update(array('flagE',0));
                        } else {
                            if($message->every_t == 0) {
                                $flag = 1;
                            //    $currentDate = $currentTime->addDays(1);
                                ScheduleMessages::find('id',$message->id)->update(array('last_date' => $currentTime->toDateString()));
                            }
                            $message->every_t++;
                            $message->every_t = $message->every_t % $message->every;
                            ScheduleMessages::find('id',$message->id)->update(array('every_t' => $message->every_t));
                        }
                    } else if($message->repeat == -2) { //Never end repeat
                        if($message->every_t == 0) {
                            $flag = 1;
                            ScheduleMessages::find('id',$message->id)->update(array('last_date' => $currentTime->toDateString()));
                        }
                        $message->every_t++;
                        $message->every_t = $message->every_t % $message->every;
                        ScheduleMessages::find('id',$message->id)->update(array('every_t' => $message->every_t));
                    } else { //repeat times
                        if($message->repeat == 0)
                            ScheduleMessages::find('id',$message->id)->update(array('flagE',0));
                        else {
                            if($message->every_t == 0) {
                                $flag = 1;
                                $message->repeat --;
                                ScheduleMessages::find('id',$message->id)->update(array('last_date' => $currentTime->toDateString()));
                                ScheduleMessages::find('id',$message->id)->update(array('repeat' => $message->repeat));
                            }
                            $message->every_t++;
                            $message->every_t = $message->every_t % $message->every;
                            ScheduleMessages::find('id',$message->id)->update(array('every_t' => $message->every_t));
                        }
                    //    if($message->repeat == 0)
                    //        ScheduleMessages::find('id',$message->id)->update(array('flagE' => 0));
                    }
                } else if($message->frequency == 'weekly') {

                } else if($message->frequency == 'monthly') {

                } else {

                }
                if($flag == 1) {
                    dispatch((new SendMessage(Message::create([
                        'account_id' => 1,
                        'sender'     => $message->sender,
                        'receiver'   => $message->receiver,
                        'text'       => $message->text,
                        'direction'  => 'outbound',
                        'status'     => 'pending',
                        'folder'     => 'chat',
                    ]))));
                }
            }
        }
    }
}
