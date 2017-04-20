<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\files
 *
 * @property int $id
 * @property string $url
 * @property string $description
 * @property int $size
 * @property int $type
 * @property string $filescol
 * @property bool $lib
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ads_has_files[] $ads_has_files
 * @method static \Illuminate\Database\Query\Builder|\App\files whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\files whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\files whereFilescol($value)
 * @method static \Illuminate\Database\Query\Builder|\App\files whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\files whereLib($value)
 * @method static \Illuminate\Database\Query\Builder|\App\files whereSize($value)
 * @method static \Illuminate\Database\Query\Builder|\App\files whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\files whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\files whereUrl($value)
 * @mixin \Eloquent
 */
class files extends Model
{
    protected $fillable = ['url', 'description', 'size', 'type', 'lib'];
    /*****
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ads_has_files(){
        return $this->hasMany('App\ads_has_files','files_ID');
    }
}
