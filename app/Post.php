<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
     protected $guarded=[];



    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function comments(){
        return $this->hasMany(comment::class);
    }
    public function favorite_to_users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
}
