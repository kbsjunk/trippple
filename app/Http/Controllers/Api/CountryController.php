<?php namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Country;
use App\Transformers\CountryTransformer;

class CountryController extends Controller {

	use \Appkr\Fractal\ApiResponse;

	/**
	 * Display a listing of the resources.
	 *
	 * @return Response
	 */
	public function index()
	{

		$results = Country::with('continent')
		->orderBy('name')
		->paginate(100);

		return $this->response()->setIncludes(\Input::get('include'))->withPagination($results, new CountryTransformer);
	}
	/**
	 * Display a listing of the resources which match the search term.
	 *
	 * @return Response
	 */
	public function search($term)
	{

		$results = Country::with('continent')
		->search($term, null, true, 10)
		->orderBy('population', 'DESC')
		->limit(20)->get();

		return $this->response()->setIncludes(\Input::get('include'))->withCollection($results, new CountryTransformer);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$place = Country::with('country')->with('region')->findOrFail($id);

		return $this->response()->setIncludes(\Input::get('include'))->withItem($place, new CountryTransformer);
	}

}
