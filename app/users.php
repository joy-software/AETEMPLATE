<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class users extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'profession',
        'email',
        'password',
        'promotion',
        'country',
        'phone',
        'photo'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     * */

    protected $hidden = [
    'password', 'remember_token',
    ];

    public function ads(){
        return $this->hasMany('App\ads', 'user_ID');
    }

    public function usergroup(){
        return $this->hasMany('App\usergroup', 'user_ID');
    }

    public function group(){
        return $this->hasMany('App\group','user_ID');
    }

    public function ballot(){
        return $this->hasMany('App\ballot','user_ID');
    }

    public function proposition(){
        return $this->hasMany('App\proposition',user_ID);
    }

    public function contribution(){
        return $this->hasMany('App\contribution','user_ID');
    }

}
