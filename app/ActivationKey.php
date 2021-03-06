<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ActivationKey
 *
 * @property int $id
 * @property int $user_id
 * @property string $activation_key
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\ActivationKey whereActivationKey($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ActivationKey whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ActivationKey whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ActivationKey whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ActivationKey whereUserId($value)
 * @mixin \Eloquent
 */
class ActivationKey extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'activation_keys';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
