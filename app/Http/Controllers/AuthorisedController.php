<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller as UnauthorisedController;

abstract class AuthorisedController extends UnauthorisedController {

	
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

}
