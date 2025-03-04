<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
class Transaction extends Model
{

    protected $fillable = [
      'amount','accountno','transdate','transref '
    ];

    public $incrementing=true;
    protected $primaryKey='transid';



    public  function account()
    {
        return $this->belongsTo('App\Account','accountno');
    }















    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Customize array...

        return $array;
    }

}
