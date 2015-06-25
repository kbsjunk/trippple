<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class Airport extends Model {

	use Eloquence;

	protected $table = 'x_airports';
	protected $primaryKey = 'fs';
	protected $increments = false;

	protected $casts = [
		'latitude'  => 'float',
		'longitude' => 'float',
	];

	protected $searchableColumns = [
		'name'         => 20,
		'iata'         => 10,
		'icao'         => 10,
		'faa'          => 10,
		'city_code'    => 8,
		'city'         => 5,
		'district'     => 2,
		'country_name' => 2,
	];

	/**
	 * The relations to eager load on every query.
	 *
	 * @var array
	 */
	protected $with = ['country'];

	public function country()
	{
		return $this->belongsTo('App\Country', 'country_code');
	}

	public function getTimezoneAttribute()
	{
		return \App\Timezone::get($this->time_zone_region_name);
	}

	public function getGeometryAttribute()
	{
		return [
		'type' => 'Point',
		'coordinates' => [$this->longitude, $this->latitude]
		];
	}

}
