<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class InstallLanguages extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'lang:install';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Install languages from caouecs/laravel-lang.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{

		$include = array_filter(explode(',', $this->argument('include')));

		if (!count($include)) {
			$include = \File::directories(base_path('vendor/caouecs/laravel4-lang'));

			foreach ($include as &$path) {
				$path = basename($path);
			}
			unset($path);
		}

		$exclude = explode(',', $this->option('exclude'));

		$include = array_diff($include, $exclude);

		foreach ($include as $path) {
			\File::copyDirectory(base_path("vendor/caouecs/laravel4-lang/$path"), base_path("resources/lang/$path"));
		}
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
		['include', InputArgument::OPTIONAL, 'The language code(s) to include, comma separated, or blank for all languages', null],
		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
		['exclude', 'x', InputOption::VALUE_OPTIONAL, 'The language code(s) to exclude, comma separated', null],
		];
	}

}
