<?php

use Illuminate\Database\Seeder;

class TypeListsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		DB::table('type_lists')->delete();

		$data =[
		[
		'code' => 'Accommodation',
		'name' => 'Accommodation',
		],
		[
		'code' => 'Journey',
		'name' => 'Journey',
		],
		[
		'code' => 'Attraction',
		'name' => 'Attraction',
		],
		[
		'code' => 'JourneyPoint',
		'name' => 'Point',
		],
		[
		'code' => 'Place',
		'name' => 'Place',
		],
		[
		'code' => 'Destination',
		'name' => 'Destination',
		],
		[
		'code' => 'Trip',
		'name' => 'Trip',
		],
		];

		DB::table('type_lists')->insert($data);
	}

}
