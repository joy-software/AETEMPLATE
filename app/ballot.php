<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ballot
 *
 * @property-read \App\group $group
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\proposition[] $proposition
 * @property-read \App\User $users
 * @mixin \Eloquent
 */
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
        return $this->belongsTo('App\User', 'user_ID');
    }

    public function group(){
        return $this->belongsTo('App\group', 'group_ID');
    }
}
