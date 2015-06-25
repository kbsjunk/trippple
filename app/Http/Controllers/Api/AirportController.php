<?php namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Airport;
use App\Transformers\AirportTransformer;

class AirportController extends Controller {

	use \Appkr\Fractal\ApiResponse;

	/**
	 * Display a listing of the resources which match the search term.
	 *
	 * @return Response
	 */
	public function search($term)
	{
		$places = Airport::with('country')
		->where('name', 'LIKE', $term.'%')
		->where('active', true)
		->get();

		return $this->response()->setIncludes(\Input::get('include'))->withCollection($places, new AirportTransformer);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$place = Airport::with('country')->with('region')->findOrFail($id);

		return $this->response()->setIncludes(\Input::get('include'))->withItem($place, new AirportTransformer);
	}

}
