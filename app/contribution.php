<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * App\contribution
 *
 * @property-read \App\period $period
 * @property-read \App\User $users
 * @mixin \Eloquent
 * @property int $id
 * @property int $amount
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $user_ID
 * @property int $period_ID
 * @property int $motif_ID
 * @method static \Illuminate\Database\Query\Builder|\App\contribution whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\contribution whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\contribution whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\contribution whereMotifID($value)
 * @method static \Illuminate\Database\Query\Builder|\App\contribution wherePeriodID($value)
 * @method static \Illuminate\Database\Query\Builder|\App\contribution whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\contribution whereUserID($value)
 */
class contribution extends Model
{
    protected $table = 'contribution';
    protected $fillable = ['amount'];

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
