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
 * @property int $id
 * @property string $description
 * @property int $id_winner
 * @property int $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $user_ID
 * @property int $group_ID
 * @method static \Illuminate\Database\Query\Builder|\App\ballot whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ballot whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ballot whereGroupID($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ballot whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ballot whereIdWinner($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ballot whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ballot whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ballot whereUserID($value)
 */
class ballot extends Model
{

    protected $table = 'ballot';
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
