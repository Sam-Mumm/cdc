<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category_list = array(
            array ('Album', false),
            array ('Single', false),
            array ('Extended Play', false),
            array ('Soundtrack', true),
            array ('Kompilation', true),
            array ('Hörbuch', false),
            array ('Hörspiel', false),
            array ('Musical', false)
        );
        for($i=0; $i<count($category_list); $i++)
        {
            DB::table('category')->insert([
                'name' => $category_list[$i][0],
                'show_artist' => $category_list[$i][1]
            ]);
        }
    }
}
