<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeList extends Model {

	protected $primaryKey = 'code';
	protected $increments = false;

	public function typeItems()
	{
		return $this->hasMany('App\TypeItem', 'type_list_code');
	}

}
