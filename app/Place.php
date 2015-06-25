<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model {

	protected $table = 'x_geonames';

	protected $with = [
		'country',
		'region',
	];

	protected $casts = [
		'latitude'  => 'float',
		'longitude' => 'float',
	];

	public function type()
	{
		return $this->belongsTo('App\TypeItem', 'type_id');
	}

	public function country()
	{
		return $this->belongsTo('App\Country', 'country_id');
	}

	public function region()
	{
		return $this->belongsTo('App\Region', 'admin1', 'fips_code')->where('country_code', $this->country_id);
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
