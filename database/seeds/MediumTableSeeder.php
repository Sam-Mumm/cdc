<?php

use Illuminate\Database\Seeder;

class MediumTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $medium_list = array('Compact Disc', 'MP3', 'Vinyl', 'Musikkassette');
        for($i=0; $i<count($medium_list); $i++)
        {
            DB::table('medium')->insert([
                'name' => $medium_list[$i]
            ]);
        }
    }
}
