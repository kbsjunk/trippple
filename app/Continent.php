<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;
use Punic\Territory;

class Continent extends Model {

	use Eloquence;

	protected $primaryKey = 'code';
	protected $increments = false;

}
