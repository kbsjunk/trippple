<?php

use Illuminate\Database\Seeder;
use App\TypeList;
use App\TypeItem;

class TypeItemsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		DB::table('type_items')->delete();

		$data =[
		'Accommodation' => [
		[
		'code' => 'Hotel',
		'name' => 'Hotel',
		],
		[
		'code' => 'Motel',
		'name' => 'Motel',
		],
		[
		'code' => 'Airbnb',
		'name' => 'airbnb',
		],
		[
		'code' => 'Home',
		'name' => 'Home',
		],
		[
		'code' => 'Apartment',
		'name' => 'Apartment',
		],
		],
		'Journey' => [
		[
		'code' => 'Flight',
		'name' => 'Flight',
		],
		[
		'code' => 'Train',
		'name' => 'Train',
		],
		[
		'code' => 'Bus',
		'name' => 'Bus',
		],
		[
		'code' => 'Car',
		'name' => 'Car',
		],
		[
		'code' => 'Walk',
		'name' => 'Walk',
		],
		[
		'code' => 'Underground',
		'name' => 'Underground',
		],
		[
		'code' => 'Tram',
		'name' => 'Tram',
		],
		[
		'code' => 'Tour',
		'name' => 'Tour',
		],
		[
		'code' => 'Taxi',
		'name' => 'Taxi',
		],
		],
		'Attraction' => [
		[
		'code' => 'Attraction',
		'name' => 'Attraction',
		],
		],
		'JourneyPoint' => [
		[
		'code' => 'NoStop',
		'name' => 'No Stop',
		],
		[
		'code' => 'Stop',
		'name' => 'Stop',
		],
		],
		'Place' => [
		[
		'code' => 'Place',
		'name' => 'Place',
		],
		[
		'code' => 'Airport',
		'name' => 'Airport',
		],
		[
		'code' => 'TrainStation',
		'name' => 'Train Station',
		],
		[
		'code' => 'BusStation',
		'name' => 'Bus Station',
		],
		[
		'code' => 'City',
		'name' => 'City',
		],
		[
		'code' => 'Region',
		'name' => 'Region',
		]
		],
		'Destination' => [
		[
		'code' => 'Destination',
		'name' => 'Destination',
		],
		],
		'Trip' => [
		[
		'code' => 'Trip',
		'name' => 'Trip',
		],
		],

		];

		foreach ($data as $list => $values) {
			$list = TypeList::whereCode($list)->first();

			foreach ($values as $value) {
				$item = new TypeItem;
				$item->fill($value);
				$list->typeItems()->save($item);
			}

		}

	}

}
