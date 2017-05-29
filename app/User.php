<?php

namespace App;


use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable,EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='users';

    protected $fillable = [
        'playerId',
        'name',
        'surname',
        'sex',
        'email',
        'description',
        'profession',
        'password',
        'promotion',
        'country',
        'phone',
        'statut',
        'activated',
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

    /**
     * Route notifications for the mail channel.
     *
     * @return string
     */
    public function routeNotificationForMail()
    {
        return $this->email;
    }

    /**
     * Route notifications for the OneSignal channel.
     *
     * @return string
     */
    public function routeNotificationForOneSignal()
    {
        return $this->playerId;
    }


}
