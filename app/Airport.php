<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Airport extends Model {

	protected $table = 'x_airports';

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

}
