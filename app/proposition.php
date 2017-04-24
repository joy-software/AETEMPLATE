<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\proposition
 *
 * @property-read \App\ballot $ballot
 * @property-read \App\User $users
 * @mixin \Eloquent
 * @property int $id
 * @property string $statement
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $user_ID
 * @property int $ballot_ID
 * @method static \Illuminate\Database\Query\Builder|\App\proposition whereBallotID($value)
 * @method static \Illuminate\Database\Query\Builder|\App\proposition whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\proposition whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\proposition whereStatement($value)
 * @method static \Illuminate\Database\Query\Builder|\App\proposition whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\proposition whereUserID($value)
 */
class proposition extends Model
{

    protected $table = 'proposition';
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
