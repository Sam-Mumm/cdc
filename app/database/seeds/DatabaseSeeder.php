<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

                $this->call('GenreTableSeeder');
                $this->call('ArtistTableSeeder');
                $this->call('CategoryTableSeeder');
                $this->call('RessourceTableSeeder');
//                $this->call('AlbumSeeder');
                
                
		// $this->call('UserTableSeeder');
	}

}
