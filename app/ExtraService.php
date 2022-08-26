<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtraService extends Model
{
    public function extraServices() {
        return $this->belongToMany('App\ExtraService');
    }

    protected $fillable = [
        'name'
    ];
}
