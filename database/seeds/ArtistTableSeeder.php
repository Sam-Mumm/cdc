<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ArtistTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for($i=0; $i<10; $i++)
        {
            DB::table('artist')->insert([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName
            ]);
        }
    }
}
