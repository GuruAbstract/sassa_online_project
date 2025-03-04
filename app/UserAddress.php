<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserAddress extends Model
{
    protected $fillable=[
        'useraddressid',
        'id',
        'usercity',
        'userhouseno',
        'userstreetname',
        'userpostalcode',
        'usercontactno',
        'usercountry',
        'userprovince',
        'isuserdeliveryaddress',
        'useraddressesmap'

    ];
    protected $primaryKey='useraddressid';

    public static function validateaddress(Request $request)
    {
        $request-> validate(
            [

                'usercity'=>['required'],

                'userhouseno'=>['required'],
                'isuserdeliveryaddress'=>['required'],
                //'userprovince'=>['nullable'],
                'usercountry'=>['required'],
                'usercontactno'=>['required'],
                'userstreetname'=>['required'],
                'userpostalcode'=>['required'],
            ]);
         return true;
    }

    public static function saveAddress(Request $request){

        $useraddressesmap= $request->file('useraddressesmap')
            ->storePublicly('public');
        $pic=substr($useraddressesmap,7);
        UserAddress::create(
            [
                'id'=>Auth::id(),
                'usercity'=>$request->input('usercity'),
                'useraddressesmap'=>$pic,
                'userhouseno'=>$request->input('userhouseno'),
                'isuserdeliveryaddress'=>$request->input('isuserdeliveryaddress'),
                'userprovince'=>$request->input('userprovince'),
                'usercountry'=>$request->input('usercountry'),
                'usercontactno'=>$request->input('usercontactno'),
                'userstreetname'=>$request->input('userstreetname'),
                'userpostalcode'=>$request->input('userpostalcode'),

            ]);



    }
}
