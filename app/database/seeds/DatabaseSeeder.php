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

		// $this->call('UserTableSeeder');
	}

}

/*
	LOAD DATA INFILE 'C:/metalData/MAAlbums.csv' INTO TABLE albums
	FIELDS TERMINATED BY ';;'
	LINES TERMINATED BY '\r\n';

/*