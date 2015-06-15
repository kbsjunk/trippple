<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Country;

class CountryNeighboursTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		DB::table('country_neighbours')->delete();
		$this->importMledozeCountries();

	}

	private function importMledozeCountries()
	{
		$json = File::get(storage_path('data/iso3166/countries.json'));
		$json = json_decode($json);

		$data = [];

		foreach ($json as $row) {
			foreach ($row->borders as $neighbour) {

				$code = strlen($neighbour) == 3 ? 'iso_alpha3_code' : 'iso_alpha2_code';
				$neighbour = Country::where($code, $neighbour)->first();

				$data[] = [
				'country_code'   => $row->cca2,
				'neighbour_code' => $neighbour->code,
				];

			}
		}

		DB::table('country_neighbours')->insert($data);
	}

}
