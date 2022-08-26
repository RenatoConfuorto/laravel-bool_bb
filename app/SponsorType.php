<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SponsorType extends Model
{
    public function apartments() {
        return $this->belongsToMany('App\Apartment');
    }
    public function sponsorTypes() {
        return $this->hasMany('App\SponsorType');
    }

    protected $fillable = [
        'price',
        'name',
        'duration_h'
    ];
}
