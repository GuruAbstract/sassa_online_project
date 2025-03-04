<?php
/**
 * Created by PhpStorm.
 * User: Donald.Tutani
 * Date: 12/4/2017
 * Time: 7:24 PM
 */
namespace App\Inject;



use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
class SupplierList
{
    public  function getSuppliers()
    {

      $supplierlist= DB::table('suppliers')
            ->select('supplierid','suppliername')
            ->get();
        return $supplierlist;

    }

}