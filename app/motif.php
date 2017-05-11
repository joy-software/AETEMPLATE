<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\motif
 *
 * @property int $id
 * @property string $reason
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\motif whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\motif whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\motif whereReason($value)
 * @method static \Illuminate\Database\Query\Builder|\App\motif whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\contribution[] $contribution
 */
class motif extends Model
{
    protected $table = 'motif';
    protected $guarded= ['id'];

    public function contribution(){
        return $this->hasMany('App\contribution','motif_ id');
    }
}
