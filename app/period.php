<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\period
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\contribution[] $contribution
 * @mixin \Eloquent
 * @property int $id
 * @property int $year
 * @property string $month
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\period whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\period whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\period whereMonth($value)
 * @method static \Illuminate\Database\Query\Builder|\App\period whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\period whereYear($value)
 */
class period extends Model
{

    //protected $fillable = ['year','description','logo'];

    protected $table = 'period';

    protected $guarded = ['id'];

    public function contribution(){
        return $this->hasMany('App\contribution','period_ID');
    }

}
