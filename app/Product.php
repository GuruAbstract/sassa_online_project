<?php

namespace App;

use Faker\Provider\DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Rules\GreaterThanThisDay;
use Laravel\Scout\Searchable;

class Product extends Model
{


    protected $fillable = [
        'productdescription',
        'productquantity',
        'productphoto',
        'discountpercentage',
        'purchaseprice',
        'sellingprice',
        'stocklevel',
        'supplierid',
        'manufactureddate',
        'productname',
        'producttype',
        'reorderlevel',
        'productid',
        'expirydate',

        ];
    public $incrementing=false;
    protected $primaryKey='productid';




    public  function validatingrequest(Request $request)
    {
        $request-> validate(
            [    'productid'=>['required','unique:products'],
                'productdescription'=>['required'],
                'productquantity'=>['required'],
                'productphoto'=>['required'],
                'discountpercentage'=>['required'],
                'purchaseprice'=>['required'],
                'sellingprice'=>['required',],
                'stocklevel'=>['required'],
                'supplierid'=>['required'],
                'manufactureddate'=>['required'],
                'productname'=>['required'],
                'producttype'=>['required'],
                'reorderlevel'=>['required'],
                'expirydate'=>['required',new GreaterThanThisDay ],
            ]
        );


    }

    public function producttype()
    {
        return $this->belongsTo('App\ProductType',
            'producttype');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Supplier','supplierid');
    }

    public function orderiterms()
    {
        return $this->hasMany('App\OrderIterm','productid');
    }




    public  function commit(Request $request)
   {
       $pic= $request->file('productphoto')->storePublicly('public');


       $pic=substr($pic,7);
       Product::create(
           [
               'productdescription'=>$request->input('productdescription'),
               'productquantity'=>$request->input('productquantity'),
               'productphoto'=>$pic,
               'productid'=>$request->input('productid'),
               'discountpercentage'=>$request->input('discountpercentage'),
               'purchaseprice'=>$request->input('purchaseprice'),
               'sellingprice'=>$request->input('sellingprice'),
               'stocklevel'=>$request->input('stocklevel'),
               'supplierid'=>$request->input('supplierid'),
               'manufactureddate'=>$request->input('manufactureddate'),
               'productname'=>$request->input('productname'),
               'producttype'=>$request->input('producttype'),
               'reorderlevel'=>$request->input('reorderlevel'),
               'expirydate'=>$request->input('expirydate'),

           ]);
   }









}
