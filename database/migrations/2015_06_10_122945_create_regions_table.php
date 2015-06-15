<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('regions', function(Blueprint $table)
		{
			$table->string('code', 10)->primary();

			$table->string('name')->index();
			$table->string('name_alt')->nullable()->index();
			
			$table->string('type')->index();

			$table->string('iso_alpha2_code', 2)->nullable()->index();
			$table->string('fips_code', 10)->nullable()->index();

			$table->unsignedInteger('area')->nullable();
			$table->unsignedInteger('population')->nullable();

			$table->decimal('latitude', 10, 7)->nullable();
			$table->decimal('longitude', 10, 7)->nullable();

			$table->unsignedInteger('geoname_id')->nullable()->index();
			$table->string('country_code', 2)->index();
			
			$table->boolean('active')->default(true);
			
			$table->timestamps();
		});

		Schema::table('regions', function(Blueprint $table)
		{
			$table->foreign('country_code')->references('code')->on('countries')->onDelete('restrict');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('regions');
	}

}
