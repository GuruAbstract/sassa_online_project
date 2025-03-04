<?php
/* User: Donald.Tutani
 * Date: 12/9/2017
 * Time: 4:17 AM*/
namespace App\Inject;
use Illuminate\Support\Facades\DB;
class DeliveryAddress
{    public  function get($id)
    {
        return  DB::table('user_addresses')
            ->where('id','=',$id)
            ->where('isuserdeliveryaddress','=',1)
            ->select('userhouseno','userstreetname',
                 'usercity','userprovince',
                 'useraddressesmap','usercountry',
                  'userpostalcode',
                   'usercontactno')
            ->get();
    }
}