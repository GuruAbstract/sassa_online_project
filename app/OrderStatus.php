<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    public $incrementing=false;
    protected $keyType='string';
    protected $primaryKey='orderstatus';

}
