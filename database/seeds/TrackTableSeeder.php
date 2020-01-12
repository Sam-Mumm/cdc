<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use \App\CD;
use \App\Artist;

class TrackTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cd_list = CD::all()->pluck('id')->toArray();
        $artist_list = Artist::all()->pluck('id')->toArray();
        $faker = Faker::create();

        for($i=0; $i<count($cd_list); $i++)
        {
            $cd_id = $cd_list[$i];
            $artist_id = $faker->randomElement($artist_list);

            for($j=1; $j<=random_int(3, 15); $j++)
            {
                DB::table('track')->insert([
                    'artist_id' => $artist_id,
                    'cd_id' => $cd_id,
                    'number' => $j,
                    'name' => $faker->word,
                    'length' => $faker->numberBetween($min = 90, $max = 2400)
                ]);
            }
        }
    }
}
