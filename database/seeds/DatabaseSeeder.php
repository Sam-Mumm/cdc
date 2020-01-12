<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ArtistTableSeeder::class,
            MediumTableSeeder::class,
            GenreTableSeeder::class,
            CategoryTableSeeder::class,
            AlbumTableSeeder::class,
            CDTableSeeder::class,
            TrackTableSeeder::class
        ]);
    }
}
