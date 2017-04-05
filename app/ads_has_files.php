<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ads_has_files extends Model
{

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