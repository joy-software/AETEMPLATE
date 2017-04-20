<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ads
 *
 * @property int $id
 * @property string $description
 * @property string $expiration_date
 * @property int $nb_like
 * @property int $type
 * @property bool $archiving
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $user_ID
 * @property int $group_ID
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ads_has_files[] $ads_has_files
 * @property-read \App\group $group
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\ads whereArchiving($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ads whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ads whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ads whereExpirationDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ads whereGroupID($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ads whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ads whereNbLike($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ads whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ads whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ads whereUserID($value)
 * @mixin \Eloquent
 */
class ads extends Model
{
    protected $fillable = ['description', 'type', 'archiving', 'expiration_date', 'nb_like', 'create_at'];

    public function ads_has_files()
    {
        return $this->hasMany('App\ads_has_files', 'ads_ID');
    }

    public function user(){
        return $this->belongsTo('App\User','user_ID');
    }

    public function group(){
        return $this->belongsTo('App\group','group_ID');
    }

}