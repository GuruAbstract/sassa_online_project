<?php
/**
 * User: Donald.Tutani
 * Date: 12/7/2017
 * Time: 6:19 AM
 */
namespace App\Inject;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class AddressList
{
    public  function getAddressList()
    {
        return DB::table('user_addresses')
                 ->  where('id',Auth::id())
                 ->get();
    }

}