<?php

use App\Apartment;
use App\ApartmentSponsorType;
use App\SponsorType;
use Illuminate\Database\Seeder;

class ApartmentSponsorTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apartments = Apartment::all();
        $sponsor_types = SponsorType::all();

        $count = 500;
        for ($i=0; $i < $count; $i++) { 
            $apartment_sponsor = new ApartmentSponsorType();

            $apartment = $apartments[rand(0, $apartments->count())];
            $sponsor_type = $sponsor_types[rand(0, $sponsor_types->count())];

            $apartment_sponsor->apartment_id = $apartment->id;
            $apartment_sponsor->sponsor_type_id = $sponsor_type->id;

            $timestamp = mt_rand(1, time());
            $apartment_sponsor->sponsor_start = date('Y-m-d H:i:s', $timestamp);

            // $apartment_sponsor->sponsor_end = ((clone $apartment_sponsor)->sponsor_start)->add(new DateInterval("PT{$sponsor_type->duration_h}H"))->format('Y-m-d H:i:s');

            $start_date = $apartment_sponsor->sponsor_start;
            $modified = (clone $start_date)->add(new DateInterval("{$sponsor_type->duration_h}"));
            $modified->format('Y-m-d H:i:s');
            $apartment_sponsor->save();
        }
    }
}
