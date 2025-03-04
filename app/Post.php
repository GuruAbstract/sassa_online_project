<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    //SEO Friendly urls
    public function getSlugAttribute():string
    {
     
     return action('PostsController@show',[$this->id,$this->slug]);
    }
   // Table Name
   protected $table = 'posts';
   // Primary Key
   public $primaryKey = 'id';
   // Timestamps
   public $timestamps = true;

   public function user()
   {
    return $this->belongsTo('App\User');
   }
   
   public function categories()
   {
    return $this->belongsTo('App\Category');
   }
}
