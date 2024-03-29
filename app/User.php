<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $guarded = array('id');
    public static $rules = array(
        'name' => 'required',
        'email' => 'required',
        'password' => 'required',
        'role' => 'required',
        );
        
    //protected $fillable = [
        //'name', 'email', 'password', 'role',
    //];


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


    public function profile_histories()
    {
      return $this->hasMany('App\Profile_history');
    }
}
