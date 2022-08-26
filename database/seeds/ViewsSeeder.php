<?php

use App\Apartment;
use App\View;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ViewsSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('views')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $apartments = Apartment::all();

        for ( $i=0; $i < 10000; $i++) {
            $apartment = $apartments[rand(0, $apartments->count() - 1)];
            
            $view = new View();
            $view->apartment_id = $apartment->id;
            $view->ip = $faker->ipv6();
            $timestamp = mt_rand(1, time());
            $view->date = date('Y-m-d H:i:s', $timestamp);
            // $view->date = $faker->dateTime('Y-m-d H:i:s');

            $view->save();
        }
    }
}
