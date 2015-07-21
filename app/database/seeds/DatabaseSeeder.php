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
                
		// $this->call('UserTableSeeder');
	}

}
