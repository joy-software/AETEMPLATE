<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\contribution
 *
 * @property-read \App\period $period
 * @property-read \App\User $users
 * @mixin \Eloquent
 */
class contribution extends Model
{
    /*****
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     */
    public function period(){
        return $this->belongsTo('App\period','period_ID');
    }

    public function users() {
        return $this->belongsTo('App\User','user_ID');
    }
}
