<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateXAirportsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('x_airports', function(Blueprint $table)
		{
			$table->string('fs', 10)->primary();
			$table->string('iata')->nullable();
			$table->string('icao')->nullable();
			$table->string('faa')->nullable();
			$table->string('name')->nullable();
			$table->string('street1')->nullable();
			$table->string('street2')->nullable();
			$table->string('city')->nullable();
			$table->string('city_code')->nullable();
			$table->string('district')->nullable();
			$table->string('state_code')->nullable();
			$table->string('postal_code')->nullable();
			$table->string('country_code')->nullable();
			$table->string('country_name')->nullable();
			$table->string('region_name')->nullable();
			$table->string('time_zone_region_name')->nullable();
			$table->string('weather_zone')->nullable();
			$table->decimal('utc_offset_hours', 4, 2)->nullable();
			$table->integer('elevation_feet')->nullable();
			$table->decimal('latitude', 10, 7)->nullable();
			$table->decimal('longitude', 10, 7)->nullable();
			$table->boolean('active');
			$table->smallInteger('classification')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('x_airports');
	}

}
