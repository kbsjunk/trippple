<?php

use Kitbs\FileSeeder\JsonFileSeeder as Seeder;

class AirportsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function prepare()
	{

		// $this->remote = 'https://api.flightstats.com/flex/airports/rest/v1/json/all?appId=f34e426f&appKey=02b7ea830924c9ca7c04f81296944e29&extendedOptions=includeNewFields';
		$this->path = storage_path('data/airports/airports.json');
		$this->table = 'x_airports';
		$this->before = 'truncate';
		$this->dataKey = 'airports';
		$this->rowLimit = 1;

	}

	public function parseRow($line)
	{

		$columns = array_keys($line);

		foreach ($columns as &$column) {
			$column = snake_case($column);
		}

		$line = array_combine($columns, array_values($line));
		
		$line['fs'] = str_replace(" ", '*', $line['fs']);

		unset($line['delay_index_url']);
		unset($line['local_time']);
		unset($line['weather_url']);

		return $line;
	}

}
