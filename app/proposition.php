<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\proposition
 *
 * @property-read \App\ballot $ballot
 * @property-read \App\User $users
 * @mixin \Eloquent
 */
class proposition extends Model
{
    /*******
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * List of belongTo.
     */

    public function users(){
        return $this->belongsTo('App\User', 'user_ID');
    }

    public function ballot(){
        return $this->belongsTo('App\ballot','ballot_ID');
    }
}
