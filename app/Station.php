<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Station extends Model {

	protected $table = 'x_stations';

	protected $casts = [
		'latitude'  => 'float',
		'longitude' => 'float',
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
		return \App\Timezone::get($this->getAttributeFromArray('time_zone'));
	}

	public function getGeometryAttribute()
	{
		return [
		'type' => 'Point',
		'coordinates' => [$this->longitude, $this->latitude]
		];
	}


}
