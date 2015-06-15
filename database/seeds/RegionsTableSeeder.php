<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Country;

class RegionsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		DB::table('regions')->delete();
		$this->importDatingVIPCountries();
		// $this->updateGeonamesCountries();

	}

	private function importDatingVIPCountries()
	{
		$json = require(storage_path('data/iso3166/subdivisions.php'));

		foreach ($json as $country => $row) {

			$data = [];

			foreach ($row as $key => $name) {
				$data[] = [
				'code'            => $country.'-'.$key,
				'iso_alpha2_code' => $key,
				'name'            => $name,

				'country_code'    => $country,

				'created_at'      => Carbon::now(),
				'updated_at'      => Carbon::now(),
				];
			}

			DB::table('regions')->insert($data);

		}

		
	}

	// private function updateGeonamesCountries()
	// {
	// 	$json = File::get(storage_path('data/iso3166/geonamesCountries.json'));
	// 	$json = json_decode($json);

	// 	foreach ($json as $row) {
	// 		$data = [
	// 		'geoname_id' => $row->name_id,
	// 		'fips_code'  => $row->fips_code ?: null,
	// 		'population' => $row->population,
	// 		];

	// 		DB::table('countries')->where('code', $row->iso_alpha2)->update($data);
	// 	}
	// }

	// private function updateTerritoryContainment()
	// {
	// 	$json = File::get(storage_path('data/iso3166/territoryContainment.json'));
	// 	$json = json_decode($json);

	// 	foreach ($json as $key => $row) {
	// 		if ($key != 'EU') {

	// 			$data = [
	// 			'continent_code' => $key,
	// 			];

	// 			DB::table('countries')->whereIn('code', $row->contains)->update($data);
	// 		}
	// 	}
	// }

}
