<?php
/**
 * Created by PhpStorm.
 * User: Donald.Tutani
 * Date: 12/13/2017
 * Time: 7:46 AM
 */

namespace App\Inject;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderStatusOption
{
public  function get()
{
    return DB::table('orderstatuses')

            ->Select('orderstatus')
            ->get();

}


}