<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Continent;

class CountriesTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		DB::table('countries')->delete();
		$this->importMledozeCountries();
		$this->updateGeonamesCountries();
		// $this->updateTerritoryContainment();

	}

	private function importMledozeCountries()
	{
		$json = File::get(storage_path('data/iso3166/countries.json'));
		$json = json_decode($json);

		$data = [];

		foreach ($json as $row) {
			$data[] = [
			'code'            => $row->cca2,
			'iso_alpha2_code' => $row->cca2,
			'iso_alpha3_code' => $row->cca3,
			'iso_num_code'    => $row->ccn3 ?: null,
			'ioc_code'        => $row->cioc ?: null,
			'name'            => $row->name->common,
			'area'            => $row->area,
			'landlocked'      => $row->landlocked,
			
			'continent_code'    => Continent::where('name', $row->region)->pluck('code'),
			'subcontinent_code' => Continent::where('name', $row->subregion)->pluck('code'),

			'latitude'        => head($row->latlng),
			'longitude'       => last($row->latlng),
			
			'created_at'      => Carbon::now(),
			'updated_at'      => Carbon::now(),
			];
		}

		DB::table('countries')->insert($data);
	}

	private function updateGeonamesCountries()
	{
		$json = File::get(storage_path('data/iso3166/geonamesCountries.json'));
		$json = json_decode($json);

		foreach ($json as $row) {
			$data = [
			'geoname_id' => $row->name_id,
			'fips_code'  => $row->fips_code ?: null,
			'population' => $row->population,
			];

			DB::table('countries')->where('code', $row->iso_alpha2)->update($data);
		}
	}

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
