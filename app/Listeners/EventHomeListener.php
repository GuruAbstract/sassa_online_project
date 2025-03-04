<?php

namespace App\Listeners;

use App\Events\EventHome;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use App\Mail\Shop;
use Illuminate\Support\Facades\Mail;
use App\Notifications\LoginnedInNotification;
class EventHomeListener
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
     * @param  EventHome  $event
     * @return void
     */
    public function handle(EventHome $event)
    {
        $user=User::find(Auth::id());

        Notification::send($user,new LoginnedInNotification($user));




    }
}
