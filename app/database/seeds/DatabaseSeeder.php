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

		// Import data for Albums table
		DB::connection()->getpdo()->exec('LOAD DATA INFILE "C:/MAMP/htdocs/p4/metalData/MAAlbums.csv" INTO TABLE albums FIELDS TERMINATED BY ";;" LINES TERMINATED BY "\r\n"');
		DB::table('albums')->where('album_id', '=', 0)
			->update(array('album_id'=>1));

		// Import data for Bands table
		DB::connection()->getpdo()->exec('LOAD DATA INFILE "C:/MAMP/htdocs/p4/metalData/MABands.csv" INTO TABLE bands FIELDS TERMINATED BY ";;;" LINES TERMINATED BY "\r\n"');
		DB::table('bands')->where('band_id', '=', 0)
			->update(array('band_id'=>1));

		// Import data for Countries table
		DB::connection()->getpdo()->exec('LOAD DATA INFILE "C:/MAMP/htdocs/p4/metalData/countries.csv" INTO TABLE countries FIELDS TERMINATED BY "," LINES TERMINATED BY "\r\n"');

		// Import data for Labels table
		DB::connection()->getpdo()->exec('LOAD DATA INFILE "C:/MAMP/htdocs/p4/metalData/labels.csv" INTO TABLE labels FIELDS TERMINATED BY "," LINES TERMINATED BY "\r\n"');

		// Import data for Reviews table
		DB::connection()->getpdo()->exec('LOAD DATA INFILE "C:/MAMP/htdocs/p4/metalData/MAReviews.csv" INTO TABLE reviews FIELDS TERMINATED BY ";;;" LINES TERMINATED BY "\r\n"');
		DB::table('bands')->where('review_id', '=', 0)
			->update(array('review_id'=>3));

		// Import data for Similar Bands table
		DB::connection()->getpdo()->exec('LOAD DATA INFILE "C:/MAMP/htdocs/p4/metalData/MASimilarArtists.csv" INTO TABLE similar_bands FIELDS TERMINATED BY "," LINES TERMINATED BY "\r\n"');
	}
}