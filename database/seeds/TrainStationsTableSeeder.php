<?php

use Kitbs\FileSeeder\CsvFileSeeder as Seeder;

class TrainStationsTableSeeder extends Seeder {

	//https://ressources.data.sncf.com/explore/dataset/osm-mapping-idf/?tab=metas
	//https://github.com/capitainetrain/stations

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function prepare()
	{

		// $this->remote = 'https://raw.githubusercontent.com/capitainetrain/stations/master/stations.csv';
		$this->path = storage_path('data/stations/stations.csv');
		$this->table = 'x_stations';
		$this->delimiter = ';';
		$this->before = 'truncate';

	}

	public function parseRow($line)
	{

		$columns = [
		'is_city',
		'is_main_station',
		'is_suggestable',
		'sncf_is_enabled',
		'idtgv_is_enabled',
		'db_is_enabled',
		'idbus_is_enabled',
		'ouigo_is_enabled',
		'trenitalia_is_enabled',
		'ntv_is_enabled',
		];

		foreach ($columns as $column) {
			$line[$column] = $line[$column] !== 'f';
		}

		$columns = array_keys($line);

		foreach ($columns as &$column) {
			if (stripos($column, ':') !== FALSE) {
				$column = str_replace(':', '_', $column);
			}
		}

		$line = array_combine($columns, array_values($line));

		return $line;
	}

}
