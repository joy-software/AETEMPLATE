<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\group
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $logo
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $user_ID
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ads[] $ads
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ballot[] $ballot
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\usergroup[] $usergroup
 * @property-read \App\User $users
 * @method static \Illuminate\Database\Query\Builder|\App\group whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\group whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\group whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\group whereLogo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\group whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\group whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\group whereUserID($value)
 * @mixin \Eloquent
 */
class group extends Model
{

    protected $fillable = ['name','description','logo'];

    protected $table = 'group';

    /******
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users(){
        return $this->belongsTo('App\User','user_ID');
    }

    /*******
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ads(){
        return $this->hasMany('App\ads','group_ID');
    }

    public function usergroup(){
        return $this->hasMany('App\usergroup','group_ID');
    }

    public function ballot(){
        return $this->hasMany('App\ballot','group_ID');
    }

}