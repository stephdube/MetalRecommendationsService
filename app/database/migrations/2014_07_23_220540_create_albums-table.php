<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('albums', function($table){
			$table->integer('album_id');
			$table->string('album_title');
			$table->bigInteger('band_id');
			$table->string('release_type');
			$table->string('label');
			$table->date('release_date');
			$table->primary(array('album_id', 'band_id'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('albums');
	}
}