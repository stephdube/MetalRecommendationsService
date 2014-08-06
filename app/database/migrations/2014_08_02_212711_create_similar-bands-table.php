<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSimilarBandsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('similar_bands', function($table){
			$table->bigInteger('band_1');
			$table->bigInteger('band_2');
			$table->integer('score');
			$table->primary(array('band_1', 'band_2'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('similar_bands');
	}

}
