<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Seeder extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
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
		DB::connection()->getpdo()->exec('LOAD DATA INFILE "C:/MAMP/htdocs/p4/metalData/MAReviews.csv" INTO TABLE reviews FIELDS TERMINATED BY "," LINES TERMINATED BY "\r\n"');

		// Import data for Similar Bands table
		DB::connection()->getpdo()->exec('LOAD DATA INFILE "C:/MAMP/htdocs/p4/metalData/MASimilarArtists.csv" INTO TABLE similar_bands FIELDS TERMINATED BY "," LINES TERMINATED BY "\r\n"');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::table('albums')->truncate();
		DB::table('bands')->truncate();
		DB::table('bookmarks')->truncate();
		DB::table('countries')->truncate();
		DB::table('labels')->truncate();
		DB::table('reviews')->truncate();
		DB::table('similar_bands')->truncate();
	}

}
