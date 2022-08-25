<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApartmentSponsorType extends Model
{
    protected $fillable = [
        'apartment_id',
        'sponsor_type_id',
        'sponsor_start',
        'sponsor_end'
    ];
}
