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

		$results = Station::with('country')
		->search($term, null, true, 10)
		->where('is_suggestable', true)
		->limit(20)->get();

		return $this->response()->setIncludes(\Input::get('include'))->withCollection($results, new StationTransformer);
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
