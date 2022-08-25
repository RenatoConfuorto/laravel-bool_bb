<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Apartment extends Model
{

    // public function services() {
    //     return $this->belongsToMany('App\')
    // }

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
        'visibilty'
    ];

    public static function generateUniqueSlug($title) {
        $base_slug = Str::slug($title, '-');
        $slug = $base_slug;
        $count = 1;
        $slug_found = Apartment::where('slug', '=', $slug)->withTrashed()->first();
        while($slug_found) {
            $slug = $base_slug . '-' . $count;
            $slug_found = Apartment::where('slug', '=', $slug)->withTrashed()->first();
            $count++;
        }
        return $slug;
    }
}
