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
 * @property string $uid
 * @property string $token
 * @property string $provider_name
 * @property string $confirmation_code
 * @property-read \App\motif $motif
 * @method static \Illuminate\Database\Query\Builder|\App\contribution_cash whereConfirmationCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\contribution_cash whereProviderName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\contribution_cash whereToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\contribution_cash whereUid($value)
 */
class contribution_cash extends Model
{

    protected $table = "contribution_cash";
    protected $fillable = ['amount','uid','token','provider_name','confirmation_code'];
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

    public function motif(){
        return $this->belongsTo('App\motif','motif_id');
    }
}
