<?php
/**
 * Created by PhpStorm.
 * User: Donald.Tutani
 * Date: 12/13/2017
 * Time: 7:43 AM
 */

namespace App\Inject;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class OrderTrackOption
{
    public  function get()
    {
        return  DB::table('order_tracks')
            ->select('accountno')
            ->get();



    }
}



