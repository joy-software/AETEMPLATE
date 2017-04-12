<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class usergroup extends Model
{
    protected $table = 'usergroup';

    protected $fillable = ['statut','notification'];

    public function users(){
        return $this->belongsTo('App\User','user_ID');
    }

    public function group(){
        return $this->belongsTo('App\group','group_ID');
    }
}