<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class JourneyPoint extends Model {

	public function journey()
	{
		return $this->belongsTo('App\Journey', 'journey_id');
	}

	public function type()
	{
		return $this->belongsTo('App\TypeItem', 'type_id');
	}
	
	public function place()
	{
		return $this->belongsTo('App\Place', 'place_id');
	}

}
