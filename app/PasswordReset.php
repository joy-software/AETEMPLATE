<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PasswordReset
 *
 * @property string $email
 * @property string $token
 * @property \Carbon\Carbon $created_at
 * @method static \Illuminate\Database\Query\Builder|\App\PasswordReset whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PasswordReset whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PasswordReset whereToken($value)
 * @mixin \Eloquent
 */
class PasswordReset extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'password_resets';
}
