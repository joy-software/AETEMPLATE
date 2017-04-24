<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class motif extends Model
{
    protected $table = 'motif';
    protected $guarded= ['id'];

    public function contribution(){
        return $this->hasMany('App\contribution','motif_ id');
    }
}
