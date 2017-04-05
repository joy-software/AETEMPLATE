<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class period extends Model
{
    public function contribution(){
        return $this->hasMany('App\contribution','period_ID');
    }

}
