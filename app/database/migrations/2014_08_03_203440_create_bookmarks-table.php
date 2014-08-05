<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookmarksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bookmarks', function($table){
			$table->integer('user_id');
			$table->integer('album_id');
			$table->timestamp('creation_date')
				->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->primary(array('user_id', 'album_id'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('bookmarks');
	}
}
