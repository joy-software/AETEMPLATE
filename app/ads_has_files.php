<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ads_has_files
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $ads_ID
 * @property int $files_ID
 * @property-read \App\ads $ads
 * @property-read \App\files $files
 * @method static \Illuminate\Database\Query\Builder|\App\ads_has_files whereAdsID($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ads_has_files whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ads_has_files whereFilesID($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ads_has_files whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ads_has_files whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ads_has_files extends Model
{
    protected $fillable = [];

    /****
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ads()
    {
        return $this->belongsTo('App\ads', 'ads_ID');

    }

    public function files(){
        return $this->belongsTo('App\files','files_ID');
    }
}