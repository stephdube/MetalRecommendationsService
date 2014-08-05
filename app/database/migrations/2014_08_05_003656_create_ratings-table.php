<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ratings', function($table){
			$table->integer('album_id');
			$table->integer('user_id');
			$table->integer('rating');
			$table->timestamp('review_date')
				->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->primary(array('album_id', 'user_id'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ratings');
	}
}
