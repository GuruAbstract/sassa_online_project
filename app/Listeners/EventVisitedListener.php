<?php

namespace App\Listeners;


use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Storage;

use App\Events\EventVisited;
class EventVisitedListener
{
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
    public function handle(EventVisited $event)
    {

        Storage::append('loginactivity.txt',$event->getMessage().' '.Carbon::now() );
    }
}
