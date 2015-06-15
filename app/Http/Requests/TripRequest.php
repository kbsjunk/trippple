<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class TripRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name'           => 'required',
			'start_place_id' => 'required',
			'end_place_id'   => '',
			'start_at'       => 'required|date',
			'end_at'         => 'date',
		];
	}

}
