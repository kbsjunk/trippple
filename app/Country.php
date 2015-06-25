<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;
use Punic\Territory;

class Country extends Model {

	use Eloquence;

	protected $primaryKey = 'code';
	protected $increments = false;

	protected $casts = [
		'latitude'  => 'float',
		'longitude' => 'float',
	];

	protected $searchableColumns = [
		'name'            => 20,
		'name_alt'        => 20,
		'fips_code'       => 10,
		'iso_alpha2_code' => 10,
		'iso_alpha3_code' => 10,
		'ioc_code'        => 5,
		'continent.name'  => 5,
	];

	public function continent()
	{
		return $this->belongsTo('App\Continent', 'continent_code');
	}

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
