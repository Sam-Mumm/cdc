<?php

use Illuminate\Database\Seeder;

class GenreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genre_list = array('Pop', 'Rock', 'Folk', 'Musical', 'Klassik', 'Hardrock', 'Heavy Metal', 'Reggae', 'Blues', 'Jazz');

        for($i=0; $i<count($genre_list); $i++)
        {
            DB::table('genre')->insert([
                'name' => $genre_list[$i]
            ]);
        }
    }
}
