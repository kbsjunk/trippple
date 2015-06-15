<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('type_items', function(Blueprint $table)
		{
			$table->string('code', 20)->primary();
			$table->string('name');
			$table->string('type_list_code', 20)->index();
			$table->timestamps();
		});

		Schema::table('type_items', function(Blueprint $table)
		{
			$table->foreign('type_list_code')->references('code')->on('type_lists')->onDelete('restrict');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('type_items');
	}

}
