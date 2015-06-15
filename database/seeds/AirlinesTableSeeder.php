<?php

use Kitbs\FileSeeder\JsonFileSeeder as Seeder;

class AirlinesTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function prepare()
	{

		// $this->remote = 'https://api.flightstats.com/flex/airlines/rest/v1/json/all?appId=f34e426f&appKey=02b7ea830924c9ca7c04f81296944e29&extendedOptions=includeNewFields';
		$this->path = storage_path('data/airports/airlines.json');
		$this->table = 'x_airlines';
		$this->before = 'truncate';
		$this->dataKey = 'airlines';
		$this->rowLimit = 1;

	}

	public function parseRow($line)
	{

		$columns = array_keys($line);

		foreach ($columns as &$column) {
			$column = snake_case($column);
		}

		$line = array_combine($columns, array_values($line));

		$line['passenger'] = in_array($line['category'], ['A', 'B', 'I', 'J', 'K']);
		$line['cargo'] = in_array($line['category'], ['C', 'D', 'I', 'J', 'K']);
		$line['scheduled'] = in_array($line['category'], ['A', 'C', 'I']);
		$line['railway'] = $line['category'] == 'K';

		return $line;
	}

}
