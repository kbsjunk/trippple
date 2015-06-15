<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Journey extends Model {

	public function trip()
	{
		return $this->belongsTo('App\Trip', 'trip_id');
	}
	
	public function type()
	{
		return $this->belongsTo('App\TypeItem', 'type_id');
	}
	
	public function startPlace()
	{
		return $this->belongsTo('App\Place', 'start_place_id');
	}
	
	public function endPlace()
	{
		return $this->belongsTo('App\Place', 'end_place_id');
	}

}
