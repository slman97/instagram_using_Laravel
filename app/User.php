<?php

namespace App;

use App\Mail\NewUserWelcomeMail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($user) {
            $user->profile()->create([
                'title' => $user->username,
            ]);
            Mail::to($user->email)->send(new NewUserWelcomeMail());
        });

    }

    public function posts()
    {
        return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');
    }

    public function following()
    {
        return $this->belongsToMany(Profile::class);
    }
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
     public function comments(){
        return $this->hasMany(comment::class);
    }
    public function favorite_posts()
    {
        return $this->belongsToMany('App\Post')->withTimestamps();
    }
    public function messinger(){
        return $this->hasMany(Massinger::class);
    }
    //#1a202c
}
