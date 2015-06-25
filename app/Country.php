<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Punic\Territory;

class Country extends Model {

	protected $primaryKey = 'code';
	protected $increments = false;

	protected $casts = [
		'latitude'  => 'float',
		'longitude' => 'float',
	];

	public function getNameAttribute()
	{
		return Territory::getName($this->code);
	}

	public function getTimezonesAttribute()
	{
		// return \App\Timezone::get($this->time_zone_region_name);
	}

	public function getGeometryAttribute()
	{
		return [
		'type' => 'Point',
		'coordinates' => [$this->longitude, $this->latitude]
		];
	}


}
