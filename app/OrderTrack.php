<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderTrack extends Model
{
    //
    protected $fillable=[
        'orderid',
         'comment',
        'orderstatus',
    ];

    protected $primaryKey='ordertrackid';

    public function orderstatus()
    {
     return $this->hasMany('App\OrderStatus','orderstatus');
    }
    
}
