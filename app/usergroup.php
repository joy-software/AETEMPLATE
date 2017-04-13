<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\usergroup
 *
 * @property int $id
 * @property int $id_validator
 * @property string $statut
 * @property bool $notification
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $user_ID
 * @property int $group_ID
 * @property-read \App\group $group
 * @property-read \App\User $users
 * @method static \Illuminate\Database\Query\Builder|\App\usergroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\usergroup whereGroupID($value)
 * @method static \Illuminate\Database\Query\Builder|\App\usergroup whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\usergroup whereIdValidator($value)
 * @method static \Illuminate\Database\Query\Builder|\App\usergroup whereNotification($value)
 * @method static \Illuminate\Database\Query\Builder|\App\usergroup whereStatut($value)
 * @method static \Illuminate\Database\Query\Builder|\App\usergroup whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\usergroup whereUserID($value)
 * @mixin \Eloquent
 */
class usergroup extends Model
{
    protected $table = 'usergroup';

    protected $fillable = ['statut','notification','id_validator'];

    public function users(){
        return $this->belongsTo('App\User','user_ID');
    }

    public function group(){
        return $this->belongsTo('App\group','group_ID');
    }
}