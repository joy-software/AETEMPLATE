<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ballot extends Model
{

    /******
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function proposition(){
        return $this->hasMany('App\proposition','ballot_ID');
    }

    /********
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users(){
        return $this->belongsTo('App\users', 'user_ID');
    }

    public function group(){
        return $this->belongsTo('App\group', 'group_ID');
    }
}
