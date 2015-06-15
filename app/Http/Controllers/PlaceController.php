<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\AuthorisedController as AuthorisedController;

use Illuminate\Http\Request;

use App\Place;
// use Ipalaus\Geonames\Eloquent\Name as Place;

class PlaceController extends AuthorisedController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function search($term)
	{
		$place = Place::with('country')
		->where('name', 'LIKE', $term.'%')
		->where(function($query) use ($term) {
			$query->orWhere('ascii_name', 'LIKE', $term.'%')
			->orWhere('alternate_names', 'LIKE', '%'.$term.'%');
		})
		->where('f_class', 'P')
		->orderBy('population', 'DESC')
		->get();

		// $place->each(function($item) {
		// 	$item->setVisible(['id', 'name', 'country', 'latitude', 'longitude', 'timezone_id']);
		// 	$item->country->setVisible(['code', 'name']);
		// });

		return $place;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
