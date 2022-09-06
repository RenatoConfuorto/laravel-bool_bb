<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Apartment extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function messages() {
        return $this->hasMany('App\Message');
    }

    public function services() {
        return $this->belongsToMany('App\ExtraService');
    }

    public function views() {
        return $this->hasMany('App\View');
    }

    public function sponsorTypes() {
        return $this->hasMany('App\ApartmentSponsorType');
    }

    protected $fillable = [
        'slug',
        'price',
        'title',
        'description',
        'rooms_number',
        'bathrooms_number',
        'beds_number',
        'mqs',
        'latitude',
        'longitude',
        'address',
        'image',
        'visibility'
    ];

    public static function generateUniqueSlug($title) {
        $base_slug = Str::slug($title, '-');
        $slug = $base_slug;
        $count = 1;
        $slug_found = Apartment::where('slug', '=', $slug)->first();
        while($slug_found) {
            $slug = $base_slug . '-' . $count;
            $slug_found = Apartment::where('slug', '=', $slug)->first();
            $count++;
        }
        return $slug;
    }

    //restituisce la distanza in Km da $_apartment
    public function getDistance($_apartment){
        $radius = 6371.0710;  //raggio terrestre in Km
        $rLat1 = $this->latitude * ( pi()/180 ); //latitudine dell'appartamento in radianti
        $rLat2 = $_apartment->latitude * ( pi()/180 ); //latitudine in rad del secondo appartamento
        $diffLat = $rLat2 - $rLat1;

        $rLong1 = $this->longitude * ( pi()/180 );
        $rLong2 = $_apartment->longitude * ( pi()/180 );
        $diffLon = $rLong2 - $rLong1;

        $distance = 2 * $radius * asin( sqrt( sin($diffLat / 2) * sin($diffLat / 2) + cos(( $rLat1 )) * cos($rLat2) * sin( $diffLon / 2) * sin( $diffLon / 2 )) );
        
        return $distance;
    }

}
