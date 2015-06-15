<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateXStationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('x_stations', function(Blueprint $table)
		{
			$table->integer('id')->unsigned()->primary();
			$table->string('name')->nullable();
			$table->string('slug')->nullable();
			$table->string('uic', 7)->nullable();
			$table->string('uic8_sncf', 8)->nullable();
			$table->decimal('longitude', 10, 7)->nullable();
			$table->decimal('latitude', 10, 7)->nullable();
			$table->integer('parent_station_id')->unsigned()->nullable();
			$table->boolean('is_city');
			$table->string('country', 2)->nullable();
			$table->boolean('is_main_station');
			$table->string('time_zone')->nullable();
			$table->boolean('is_suggestable');
			$table->string('sncf_id')->nullable();
			$table->boolean('sncf_is_enabled');
			$table->string('idtgv_id')->nullable();
			$table->boolean('idtgv_is_enabled');
			$table->string('db_id')->nullable();
			$table->boolean('db_is_enabled');
			$table->string('idbus_id')->nullable();
			$table->boolean('idbus_is_enabled');
			$table->string('ouigo_id')->nullable();
			$table->boolean('ouigo_is_enabled');
			$table->string('trenitalia_id')->nullable();
			$table->boolean('trenitalia_is_enabled');
			$table->string('ntv_id')->nullable();
			$table->boolean('ntv_is_enabled');
			$table->integer('same_as')->unsigned()->nullable();
			$table->string('info_fr')->nullable();
			$table->string('info_en')->nullable();
			$table->string('info_de')->nullable();
			$table->string('info_it')->nullable();
			$table->string('info_cs')->nullable();
			$table->string('info_da')->nullable();
			$table->string('info_es')->nullable();
			$table->string('info_hu')->nullable();
			$table->string('info_ja')->nullable();
			$table->string('info_ko')->nullable();
			$table->string('info_nl')->nullable();
			$table->string('info_pl')->nullable();
			$table->string('info_pt')->nullable();
			$table->string('info_ru')->nullable();
			$table->string('info_sv')->nullable();
			$table->string('info_tr')->nullable();
			$table->string('info_zh')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('x_stations');
	}

}
