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
class AccountsNoList
{
    public  function get()
    {
        return  DB::table('accounts')
            ->where('accounts.id','=',Auth::id())
            ->select('accountno')
            ->get();



    }
}