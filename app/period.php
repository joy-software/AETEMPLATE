<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\period
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\contribution[] $contribution
 * @mixin \Eloquent
 */
class period extends Model
{
    public function contribution(){
        return $this->hasMany('App\contribution','period_ID');
    }

}
