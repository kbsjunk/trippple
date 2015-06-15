<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountryNeighboursPivot extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('country_neighbours', function(Blueprint $table)
		{
			$table->string('country_code', 2);
			$table->string('neighbour_code', 2);
		});

		Schema::table('country_neighbours', function(Blueprint $table)
		{
			$table->foreign('country_code')->references('code')->on('countries')->onDelete('cascade');
			$table->foreign('neighbour_code')->references('code')->on('countries')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('country_neighbours');
	}

}
