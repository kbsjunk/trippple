<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeItem extends Model {

	protected $primaryKey = 'code';
	protected $increments = false;

	public function typeList()
	{
		return $this->belongsTo('App\TypeList', 'type_list_code');
	}

}
