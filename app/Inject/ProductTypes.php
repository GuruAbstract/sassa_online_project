<?php
/**
 * Created by PhpStorm.
 * User: Donald.Tutani
 * Date: 12/4/2017
 * Time: 7:24 PM
 */
namespace App\Inject;

use App\ProductType;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
class ProductTypes
{
    public  function getProductTypes()
    {


        return DB::table('product_types')
                     ->select('producttype')
                     ->get();

    }

}