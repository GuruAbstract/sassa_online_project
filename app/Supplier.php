<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{

    protected $fillable=['suppliername',
                        'supplieraddress',
                        'suppliercontactno'];
    protected $primaryKey='supplierid';

    public  function products()
    {
        return $this->hasMany('App\Product','supplierid');
    }

    public function producttypes()
    {

        return  $this->belongsToMany('App\ProductType',
            'products',
              'supplierid',
            'producttype'
            );



    }


    public  function orderitems(){


            return $this->hasManyThrough('App\OrderItem'
                ,'App\Product'
                ,'supplierid','productid'
            );

    }
}
