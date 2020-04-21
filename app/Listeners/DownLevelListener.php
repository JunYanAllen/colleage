<?php

namespace App\Listeners;

use App\Events\DownLevelEvent;
use App\Mail\DownLevelMail;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class DownLevelListener implements ShouldQueue
{
    public $tries = 5;
    public $timeout = 120;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(DownLevelEvent $event)
    {
        try{
            $student = User::find($event->data);
            Mail::to($student->email)->send(new DownLevelMail($student));
        }catch (\Exception $e){
            Log::error("郵件錯誤".$e->getMessage());
        }
    }
}
