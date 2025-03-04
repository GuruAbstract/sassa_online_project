<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected  $fillable=['producttype'];


    protected $primaryKey ='producttype';
    protected $keyType='string';

    public  function products()
    {
        return $this->hasMany('App\Product','producttype');
    }
    public function suppliers()
    {

        return  $this->belongsToMany('App\Supplier',
            'products',
            'producttype',
            'supplierid');




    }




}
