<?php
use Faker\Factory as Faker;
class GenreTableSeeder extends Seeder{
    public function run()
    {
        $faker = Faker::create();
        for($i=0; $i<10;$i++)
        {
            $genre=new Genre();
            $genre->name = $faker->unique()->word();
            $genre->save();
        }
    }
}