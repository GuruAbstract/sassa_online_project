<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'id','balance','accountno','pin','limitamount','dailylimit',
    ];


    public $incrementing=false;
    protected $primaryKey='accountno';


    public  function user()
    {
        return $this->belongsTo('App\User','id');

    }

    public  function transactions()
    {
        return $this->hasMany('App\Transaction','accountno');
    }










}
