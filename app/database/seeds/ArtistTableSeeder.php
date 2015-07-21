<?php
use Faker\Factory as Faker;
class ArtistTableSeeder extends Seeder{
    public function run()
    {
        $faker = Faker::create();
        for($i=0; $i<10;$i++)
        {
            $artist=new Artist();
            $artist->first_name = $faker->unique()->firstName();
            $artist->last_name = $faker->unique()->lastName();
            $artist->save();
        }
    }
}