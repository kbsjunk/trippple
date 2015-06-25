<?php namespace App;

use Punic\Data;
use Punic\Calendar;

class Timezone {

	public static function get($timezone)
	{
		$model = new static;

		$model->id = $timezone;
		$model->name = Calendar::getTimezoneNameNoLocationSpecific($timezone);

		return $model;
	}

}
