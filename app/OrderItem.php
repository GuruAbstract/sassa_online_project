<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable=[

        'orderid',
        'productid',
        'userid',
        'percentagediscount',
        'productunitcost',
        'productqty',
        'producttotalcost',
    ];

protected  $primaryKey='orderitemid';

    public function order()
    {
        return $this->belongsTo('App\Order','orderid');
    }

    public  function product(){
        return $this->belongsTo('App\Product','productid');
    }

}
