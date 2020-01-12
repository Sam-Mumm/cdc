<?php

use Illuminate\Database\Seeder;
use \App\Album;

class CDTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $album_list = Album::all()->pluck('id')->toArray();

        for($i=0; $i<count($album_list); $i++)
        {
            $album_id = $album_list[$i];

            for($j=1; $j<=random_int(1, 3); $j++)
            {
                DB::table('cd')->insert([
                    'album_id' => $album_id,
                    'cd_no' => $j
                ]);
            }
        }
    }
}
