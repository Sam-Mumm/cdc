<?php

use App\Album;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use \App\Genre;
use \App\Category;
use \App\Medium;
use \App\Artist;

class AlbumTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genre_list = Genre::all()->pluck('id')->toArray();
        $medium_list = Medium::all()->pluck('id')->toArray();
        $artist_list = Artist::all()->pluck('id')->toArray();

        $this->show_artist($genre_list, $medium_list);

        $this->hide_artist($genre_list, $medium_list, $artist_list);

    }

    public function show_artist($genre, $medium)
    {
        $category_list = Category::all()->where('show_artist', true)->pluck('id')->toArray();

        $faker = Faker::create();

            factory(Album::class, 20)->create([
                'genre_id' => $faker->randomElement($genre),
                'category_id' => $faker->randomElement($category_list),
            ]);
    }

    public function hide_artist($genre, $medium, $artist)
    {
        $category_list = Category::all()->where('show_artist', false)->pluck('id')->toArray();
        $faker = Faker::create();

        for($i=0; $i<20; $i++)
        {
            $id = DB::table('album')->insert([
                'title' => $faker->word,
                'year' => $faker->numberBetween($min = 1970, $max = 2020),
                'genre_id' => $faker->randomElement($genre),
                'category_id' => $faker->randomElement($category_list),
                'medium_id' => $faker->randomElement($medium)
            ]);

            DB::table('album_artist')->insert([
                'album_id' => $id,
                'artist_id' => $faker->randomElement($artist)
            ]);
        }
    }
}
