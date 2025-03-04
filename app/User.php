<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;
 public function __construct(array $attributes = [])
 {
     parent::__construct($attributes);
 }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','surname'
        ,'nationality','nationalid','photo',
         'cellnumber',
    ];

    protected $hidden = [
         'remember_token','password',
    ];


    protected $primaryKey='id';






    public function orders()
    {
        return $this->hasMany('App\Order',
                     'userid');


    }


   public  function useraddresses(){
        return $this->hasMany('App\UserAddress','id');
   }

   public  function transactions()
   {
       return $this->hasManyThrough('App\Transaction'
           ,'App\Account'
           ,'id','accountno'
       );
   }

  public  function roles()
  {
      return $this->belongsToMany(
          'App\Role',
          'role_users',
          'user_id',
          'role_id'

        );
		    
  }

  public function posts(){
    return $this->hasMany('App\Post');
}





    public function orderitems()
   {
       return $this->hasManyThrough('App\OrderItem',
                               'App\Order',
                                'userid',
                                'orderid');;

   }






    public static  function addAccount($user)
    {
        $newaccountno = DB::table("accounts")
            ->max('accountno');
        if ($newaccountno == null) {

            $newaccountno = 1000000000000000;
        }else{
            $newaccountno=$newaccountno+1;
        }

        $newpin = rand(1330, 9999);

        DB::table('accounts')->insert([
            "id" => $user->id,
            "accountno" => $newaccountno,
            "pin" => $newpin
        ]);
    }
}
