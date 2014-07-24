<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBandsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bands', function($table){
			$table->bigInteger('band_id');
			$table->string('band_name');
			$table->string('genre');
			$table->string('country');
			$table->string('location');
			$table->string('status');
			$table->string('year_creation');
			$table->primary('band_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('bands');
	}
}