<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\AuthorisedController as AuthorisedController;

use Illuminate\Http\Request;
use App\Http\Requests\TripRequest;

use App\Trip;
use App\Place;

class TripController extends AuthorisedController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$trips = Trip::with('startPlace')->with('endPlace')->get();

		return view('trips.index', compact('trips'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return $this->showForm('create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(TripRequest $request)
	{
		$trip = new Trip;

		$trip->fill($request->request->all())->save();

		return redirect()->route('trips.edit', $trip->id)->withSuccess(trans('messages.success.saved', compact('id')));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$trip = Trip::with('startPlace')->with('endPlace')->find($id);

		if (!$trip) {

			return redirect()->route('trips.index')->withErrors(trans('messages.error.not_found', compact('id')));
		}

		return view('trips.form', compact('trip')); //show

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return $this->showForm('update', $id);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(TripRequest $request, $id)
	{
		if ( ! $trip = Trip::find($id))
		{
			return redirect()->route('trips.index')->withErrors(trans('messages.error.not_found', compact('id')));
		}

		$trip->fill($request->request->all())->save();

		return redirect()->route('trips.edit', $trip->id)->withSuccess(trans('messages.success.saved', compact('id')));
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

	private function showForm($mode, $id = null)
	{
		// Do we have a trip identifier?
		if (isset($id))
		{
			if ( ! $trip = Trip::find($id))
			{
				return redirect()->route('trips.index')->withErrors(trans('messages.error.not_found', compact('id')));
			}
		}
		else
		{
			$trip = new Trip;
		}

		// Show the page
		return view('trips.form', compact('mode', 'trip'));

	}

}
