<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Trip extends Model {

	protected $dates = [
	'start_at',
	'end_at',
	];

	protected $fillable = [
	'name',
	'start_place_id',
	'end_place_id',
	'start_at',
	'start_at_tz',
	'end_at',
	'end_at_tz',
	];

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

	public function getNgModelAttribute()
	{
		return 'trip';
	}

}
