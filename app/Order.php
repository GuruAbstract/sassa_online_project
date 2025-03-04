<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=[


                  'created_at',
                  'updated_at',
                  'userid',
                  'groupid',
                  'totalcost',
                  'deliveryaddressid',
                   'deliveryaddressid',
    ];

    protected  $primaryKey='orderid';

    public function order_items()
    {
        return $this->hasMany('App\OrderItem','orderid');
    }

    public function user()
    {
        return $this->belongsTo('App\User','userid');
    }
    public function order_tracks()
    {
        return $this->hasMany('App\OrderTrack','orderid');
    }

    public function products()
    {
        return $this->belongsToMany(
            'App\Product','Order_items'
            ,'orderid','productd');
    }

}
