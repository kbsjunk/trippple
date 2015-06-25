<?php namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Place;
use App\Transformers\PlaceTransformer;

class PlaceController extends Controller {

	use \Appkr\Fractal\ApiResponse;

	/**
	 * Display a listing of the resources which match the search term.
	 *
	 * @return Response
	 */
	public function search($term)
	{
		$places = Place::with('country')->with('region')
		->where(function($query) use ($term) {
			$query->where('name', 'LIKE', $term.'%')
			->orWhere('ascii_name', 'LIKE', $term.'%')
			->orWhere(\DB::raw('\',\'||alternate_names'), 'LIKE', '%,'.$term.'%');
		})
		->where('f_class', 'P')
		->orderBy('population', 'DESC')
		->limit(20)
		->get();

		return $this->response()->setIncludes(\Input::get('include'))->withCollection($places, new PlaceTransformer);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$place = Place::with('country')->with('region')->findOrFail($id);

		return $this->response()->setIncludes(\Input::get('include'))->withItem($place, new PlaceTransformer);
	}

}
