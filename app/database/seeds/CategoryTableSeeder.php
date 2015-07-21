<?php
use Faker\Factory as Faker;
class CategoryTableSeeder extends Seeder{
    public function run()
    {
        $faker = Faker::create();
        for($i=0; $i<10;$i++)
        {
            $category=new Category();
            $category->name = $faker->unique()->word();
            $category->show_artist = $i%2;

            $category->save();
        }
    }
}