<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateXAirlinesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('x_airlines', function(Blueprint $table)
		{
			$table->string('fs', 10)->primary();
			$table->string('iata')->nullable();
			$table->string('icao')->nullable();
			$table->string('name')->nullable();
			$table->string('short_name')->nullable();
			$table->string('phone_number')->nullable();
			$table->boolean('active');
			$table->string('category', 1)->nullable();
			$table->boolean('passenger');
			$table->boolean('cargo');
			$table->boolean('scheduled');
			$table->boolean('railway');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('x_airlines');
	}

}
