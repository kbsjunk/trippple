<?php namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Station;
use App\Transformers\StationTransformer;

class StationController extends Controller {

	use \Appkr\Fractal\ApiResponse;

	/**
	 * Display a listing of the resources which match the search term.
	 *
	 * @return Response
	 */
	public function search($term)
	{
		$places = Station::with('country')
		->where('name', 'LIKE', $term.'%')
		->where('is_suggestable', true)
		->get();

		return $this->response()->setIncludes(\Input::get('include'))->withCollection($places, new StationTransformer);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$place = Station::with('country')->with('region')->findOrFail($id);

		return $this->response()->setIncludes(\Input::get('include'))->withItem($place, new StationTransformer);
	}

}
