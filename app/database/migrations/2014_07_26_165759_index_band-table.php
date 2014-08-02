<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IndexBandTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('bands', function($table){
			$table->index('band_name');
			$table->index('genre');
			$table->index('country');
			$table->index('location');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('albums', function($table){
			$table->dropIndex('bands_band_name_index');
			$table->dropIndex('albums_genre_index');
			$table->dropIndex('albums_country_index');
			$table->dropIndex('albums_location_index');
		});
	}

}
