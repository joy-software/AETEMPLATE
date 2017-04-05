<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class files extends Model
{
    /*****
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ads_has_files(){
        return $this->hasMany('App\ads_has_files','files_ID');
    }
}
