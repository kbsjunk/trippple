<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ContinentsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		DB::table('continents')->delete();
		$this->importCldrTerritories();
		$this->updateGeonamesTerritories();
		$this->updateTerritoryContainment();

	}

	private function importCldrTerritories()
	{
		$json = File::get(storage_path('data/iso3166/continents.json'));
		$json = json_decode($json);

		$data = [];

		foreach ($json as $key => $row) {
			$data[] = [
			'code'         => $key,
			'iso_num_code' => is_numeric($key) ? $key : null,
			'name'         => $row,
			'created_at'   => Carbon::now(),
			'updated_at'   => Carbon::now(),
			];
		}

		DB::table('continents')->insert($data);
	}

	private function updateGeonamesTerritories()
	{
		$json = File::get(storage_path('data/iso3166/geonamesContinents.json'));
		$json = json_decode($json);

		foreach ($json as $row) {
			$data = [
			'iso_alpha2_code' => $row->code,
			'geoname_id'      => $row->name_id,
			'active'          => is_numeric($row->code),
			];

			DB::table('continents')->where('name', $row->name)->update($data);
		}
	}

	private function updateTerritoryContainment()
	{
		$json = File::get(storage_path('data/iso3166/territoryContainment.json'));
		$json = json_decode($json);

		foreach ($json as $key => $row) {
			$data = [
			'continent_code' => $key,
			];

			DB::table('continents')->whereIn('code', $row->contains)->update($data);
		}
	}

}
