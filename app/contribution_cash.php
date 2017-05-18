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
 * @property string $ProcessingNumber
 * @property string $SenderNumber
 * @property string $ReceiverNumber
 * @property string $TransactionID
 * @method static \Illuminate\Database\Query\Builder|\App\contribution_cash whereProcessingNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\contribution_cash whereSenderNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\contribution_cash whereReceiverNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\contribution_cash whereTransactionID($value)
 */
class contribution_cash extends Model
{

    protected $table = "contribution_cash";
    protected $fillable = ['amount','ProcessingNumber','SenderNumber','ReceiverNumber','TransactionID'];
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
