<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContinentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('continents', function(Blueprint $table)
		{
			$table->string('code', 3)->primary();
			
			$table->string('name')->index();
			$table->string('name_alt')->nullable()->index();
			
			$table->string('iso_alpha2_code', 2)->nullable()->index();
			$table->string('iso_num_code', 3)->nullable()->index();

			$table->decimal('latitude', 10, 7)->nullable();
			$table->decimal('longitude', 10, 7)->nullable();

			$table->unsignedInteger('geoname_id')->nullable()->index();
			$table->string('continent_code', 3)->nullable()->index();

			$table->boolean('active')->default(true);

			$table->timestamps();

		});

		Schema::table('continents', function(Blueprint $table)
		{
			$table->foreign('continent_code')->references('code')->on('continents')->onDelete('set null');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('continents');
	}

}
