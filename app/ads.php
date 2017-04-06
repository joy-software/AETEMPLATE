<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ads extends Model
{
    public function ads_has_files()
    {
        return $this->hasMany('App\ads_has_files', 'ads_ID');
    }

    public function user(){
        return $this->belongsTo('App\User','user_ID');
    }

    public function group(){
        return $this->belongsTo('App\group','group_ID');
    }

}