<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;

use Goutte\Client;
use File;

class DownloadIso extends Command implements SelfHandling, ShouldBeQueued {

	use InteractsWithQueue, SerializesModels;

	protected $language;
	protected $country;
	protected $client;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($language, $country)
	{
		$this->language = $language;
		$this->country = $country;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$this->client = new Client();

		$language = strtolower($this->language);
		$country = strtoupper($this->country);

		$url = 'http://'.$language.'.wikipedia.org/wiki/ISO_3166-2:'.$country;

		$crawler = $client->request('GET', $url);

		$tables = $crawler->filter('table.wikitable.sortable, table.prettytable.sortable')->each(function ($table) {

			try {
				$heading = $table->previousAll()->filter('h2,h3')->first();

				if (in_array($heading->nodeName(), ['h2', 'h3'])) {
					$heading = $heading->text();
					$heading = preg_replace('/\[.*\]/', '', $heading);
				}
				else {
					$heading = 'Codes';
				}
			}
			catch (InvalidArgumentException $e) {
				$heading = 'Codes';
			}

			$trs = $table->filter('tr')->each(function ($tr) {
				if (count($tr->filter('th')) > 0) {
					return $tr->filter('th,td')->each(function ($td) {
						return [
						'colspan' => (int) $td->attr('colspan') ?: 1,
						'rowspan' => (int) $td->attr('rowspan') ?: 1,
						];
					});
				}
				return null;
			});


			$trs = array_filter($trs, function($tr) {
				return !is_null($tr);
			});

			return [ 'heading' => $heading,
			'columns' => $trs,
			'table' =>
			$table->filter('tr')->each(function ($tr) {

				return $tr->filter('th,td')->each(function ($td) {

					$text = $td->text();

					$text = preg_replace('/.*!(.*)/', '$1', $text);
					$text = preg_replace('/\[note.*\]/', '', $text);
					$text = str_replace('—', '', $text);
					$text = preg_replace('/^Subdivision /', '', $text);

					if (preg_match('/^(In|Parent) .*/', $text)) {
						$text = 'Parent';
					}

					$text = str_replace(chr(194) . chr(160),' ', $text);

					$text = preg_replace('/\s+/', ' ', $text);

					return trim($text);
				});
			})
			];
		});

$filesCount = 0;

if (count($tables)) {

	foreach ($tables as $idx => $table) {

		$heading = $table['heading'];
		$columns = $table['columns'];
		$data    = $table['table'];

		$directory = storage_path('meta/iso3166-2/'.$language.'/'.$country);
		$filename = str_slug($heading).'.json';

		if ($filename == 'codes.json') {
			if ($filesCount > 0) {
				$filename = 'codes-'.$filesCount.'.json';
			}
			$filesCount++;
		}

		$headerRows = array_slice($data, 0, count($columns));
		$data = array_slice($data, count($columns));

		$headers = [];

		foreach ($columns as $row => $cells) {
			$col = -1;
			foreach ($cells as $column => $spans) {
				for ($c=1; $c <= $spans['colspan']; $c++) { 
					$col++;
					for ($r=1; $r <= $spans['rowspan']; $r++) {
						
						$rowIn = $row+$r;
						$colIn = $col;

						if ($row > 0) {
							while (isset($headers[$rowIn][$colIn])) {
								$colIn++;
							}
						}

						$headers[$rowIn][$colIn] = $headerRows[$row][$column];
					}
				}
			}
		}
		foreach ($headers as &$header) {
			ksort($header);
		}	
		unset($header);

		$headerRows = $headers;
		$headers = [];

		foreach ($headerRows as $headerRow) {
			foreach ($headerRow as $key => $header) {
				$headers[$key][] = $header;
			}
		}

		foreach ($headers as &$header) {
			$header = implode(' / ', array_filter(array_unique($header)));
		}
		unset($header);

		$headers = array_map('str_slug', $headers);

		foreach ($data as &$row) {
			if (count($headers) > count($row)) {
				$row = array_pad($row, count($headers), '');
			}
			$row = array_combine($headers, $row);

			if ($country == 'GB' and preg_match('/(?P<name>[^[]+) \[(?P<name_cy>.*?) ?(?P<code_cy>GB-[A-Z]{3})?\]/', @$row['name-en'], $matches)) {
				$row['name-cy'] = trim(@$matches['name_cy']);
				$row['code-cy'] = trim(@$matches['code_cy']);
				$row['name-en'] = trim(@$matches['name']);
			}
		}

		$contents = json_encode($data, JSON_PRETTY_PRINT);

		File::makeDirectory($directory, 0755, true, true);
		File::put($directory.'/'.$filename, $contents);

		// ------------------------------------ //

		$directory = storage_path('meta/iso3166-2/'.$language);
		$filename = '_meta.json';

		$contents = [];

		if (File::exists($directory.'/'.$filename)) {
			$contents = File::get($directory.'/'.$filename);
			$contents = json_decode($contents, true);
		}
		else {
			$contents = [];
		}

		$contents['by_country'][$country] = $headers;

		foreach ($headers as $header) {
			$contents['by_header'][$header][] = $country;
			$contents['by_header'][$header] = array_unique($contents['by_header'][$header]);
		}

		$contents = json_encode($contents, JSON_PRETTY_PRINT);

		File::put($directory.'/'.$filename, $contents);

	}
}

}
}