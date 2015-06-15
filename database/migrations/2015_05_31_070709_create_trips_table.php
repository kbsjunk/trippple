<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('trips', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('name');

			$table->string('start_place_id');
			$table->string('end_place_id');

			$table->datetime('start_at')->nullable();
			$table->string('start_at_tz')->nullable();
			$table->datetime('end_at')->nullable();
			$table->string('end_at_tz')->nullable();
			
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('trips');
	}

}
