<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
   protected $fillable=['rolename'];
    public $incrementing=false;
 protected  $primaryKey='id' ;

 public  function role_users()
{
    return $this->hasMany('App\RoleUser','role_id');
}

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_users');
    }


}
