<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class Station extends Model {

	use Eloquence;

	protected $table = 'x_stations';

	protected $casts = [
		'latitude'  => 'float',
		'longitude' => 'float',
	];

	protected $searchableColumns = [
		'name'         => 20,
		'info_fr'      => 10,
		'info_en'      => 10,
		'info_de'      => 10,
		'info_it'      => 10,
		'info_cs'      => 10,
		'info_da'      => 10,
		'info_es'      => 10,
		'info_hu'      => 10,
		'info_ja'      => 10,
		'info_ko'      => 10,
		'info_nl'      => 10,
		'info_pl'      => 10,
		'info_pt'      => 10,
		'info_ru'      => 10,
		'info_sv'      => 10,
		'info_tr'      => 10,
		'info_zh'      => 10,
		'country.name' => 2,
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
