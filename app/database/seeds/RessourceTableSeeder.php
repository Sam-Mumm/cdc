<?php
use Faker\Factory as Faker;
class RessourceTableSeeder extends Seeder{
    public function run()
    {
        $faker = Faker::create();
        for($i=0; $i<10;$i++)
        {
            $ressource=new Ressource();
            $ressource->name = $faker->unique()->word();
            $ressource->save();
        }
    }
}