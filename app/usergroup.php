<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class usergroup extends Model
{
    public function users(){
        return $this->belongsTo('App\users','user_ID');
    }

    public function group(){
        return $this->belongsTo('App\group','group_ID');
    }
}