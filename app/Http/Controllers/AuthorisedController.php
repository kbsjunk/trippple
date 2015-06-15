<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller as UnauthController;

abstract class AuthorisedController extends UnauthController {

	
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
