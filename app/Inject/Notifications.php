<?php
/**
 * Created by PhpStorm.
 * User: Donald.Tutani
 * Date: 12/9/2017
 * Time: 4:17 AM
 */

namespace App\Inject;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
class Notifications
{
    public  function getUnreadNotifications()
    {
        $user = User::find(Auth::id());

       $notifications= $user->unreadNotifications;

       return $notifications;

    }
}