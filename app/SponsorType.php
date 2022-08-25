<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SponsorType extends Model
{
    protected $fillable = [
        'price',
        'name',
        'duration_h'
    ];
}
