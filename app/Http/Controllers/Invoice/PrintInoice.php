<?php
/**
 * Created by PhpStorm.
 * User: Donald.Tutani
 * Date: 12/10/2017
 * Time: 6:20 PM
 */

namespace App\Http\Controllers\invoice;

use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
class PrintInoice
{

public $name;
public $id;
public $rolename;
   public  function invoice(PDF $pdf)
   {
       return  $pdf->download('invoice.pdf');
   }


}