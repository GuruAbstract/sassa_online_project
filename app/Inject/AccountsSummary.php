<?php
/**
 * Created by PhpStorm.
 * User: Donald.Tutani
 * Date: 12/9/2017
 * Time: 2:45 AM
 */

namespace App\Inject;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class AccountsSummary
{
    public  function getAccountSummaryForThisUser()
    {
        $userall=DB::table('users')
            ->join('accounts','users.id','=','accounts.id')
            ->where('users.id','=',Auth::id())
           ->get();

        return view('home',compact('userall'));

    }

}