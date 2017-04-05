<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class group extends Model
{

    /******
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users(){
        return $this->belongsTo('App\users','user_ID');
    }

    /*******
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ads(){
        return $this->hasMany('App\ads','group_ID');
    }

    public function usergroup(){
        return $this->hasMany('App\usergroup','group_ID');
    }

    public function ballot(){
        return $this->hasMany('App\ballot','group_ID');
    }

}