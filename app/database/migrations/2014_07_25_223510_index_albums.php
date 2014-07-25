<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IndexAlbums extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('albums', function($table){
			$table->index('album_title');
			$table->index('release_type');
			$table->index('label');
			$table->index('release_date');
			$table->index('album_id');
			$table->index('band_id');
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
			$table->dropIndex('albums_album_title_index');
			$table->dropIndex('albums_release_type_index');
			$table->dropIndex('albums_label_index');
			$table->dropIndex('albums_release_date_index');
			$table->dropIndex('albums_album_id_index');
			$table->dropIndex('albums_band_id_index');
		});
	}

}
