<?php

use App\Apartment;
use App\ApartmentSponsorType;
use App\SponsorType;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ApartmentSponsorTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $apartments = Apartment::all();
        $sponsor_types = SponsorType::all();

        $count = 500;
        for ($i=0; $i < $count; $i++) { 
            $apartment_sponsor = new ApartmentSponsorType();

            $apartment = $apartments[rand(0, $apartments->count() - 1)];
            $sponsor_type = $sponsor_types[rand(0, $sponsor_types->count() - 1)];

            $apartment_sponsor->apartment_id = $apartment->id;
            $apartment_sponsor->sponsor_type_id = $sponsor_type->id;

            
            // generiamo una data unix
            $date_start_unix = $faker->unixTime();
            $date_start = date('Y-m-d H:i:s', $date_start_unix);
            $date_end_unix = strtotime($date_start) + ($sponsor_type->duration_h * 60 * 60);
            $date_end = date('Y-m-d H:i:s', $date_end_unix);

            $apartment_sponsor->sponsor_start = $date_start;
            $apartment_sponsor->sponsor_end = $date_end;

            $apartment_sponsor->save();

            // $timestamp = mt_rand(1, time());
            // $apartment_sponsor->sponsor_start = date('Y-m-d H:i:s', $timestamp);

            // $apartment_sponsor->sponsor_end = ((clone $apartment_sponsor)->sponsor_start)->add(new DateInterval("PT{$sponsor_type->duration_h}H"))->format('Y-m-d H:i:s');

            // $start_date = $apartment_sponsor->sponsor_start;
            // $modified = (clone $start_date)->add(new DateInterval("{$sponsor_type->duration_h}"));
            // $modified->format('Y-m-d H:i:s');
            // $apartment_sponsor->save();
        }
    }
}
