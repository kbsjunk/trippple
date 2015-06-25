<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model {

	protected $primaryKey = 'code';
	protected $increments = false;

	protected $casts = [
		'latitude'  => 'float',
		'longitude' => 'float',
	];

	public function getGeometryAttribute()
	{
		return [
		'type' => 'Point',
		'coordinates' => [$this->longitude, $this->latitude]
		];
	}


}
