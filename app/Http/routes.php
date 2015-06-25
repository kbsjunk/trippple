<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
// $languages = array('en', 'de', 'fr', 'es');

// $locale = Request::segment(1);

// if(in_array($locale, $languages)) {
// 	App::setLocale($locale);
// 	Punic\Data::setDefaultLocale($locale);
// }
// else {
// 	$locale = null;
// }

Punic\Data::setDefaultLocale(App::getLocale());
Punic\Data::setFallbackLocale(config('app.fallback_locale'));

// Route::group(['prefix' => $locale], function() {

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
	]);

Route::resource('places', 'PlaceController');


Route::resource('trips', 'TripController');
Route::resource('trips.destinations', 'DestinationController');
Route::resource('trips.attractions', 'AttractionController');

// });

Route::group(['prefix' => 'api'], function() {

	Route::get('countries/search/{query}', 'Api\CountryController@search');
	Route::get('countries/{id}', 'Api\CountryController@show');
	Route::get('countries', 'Api\CountryController@index');

	Route::get('places/search/{query}', 'Api\PlaceController@search');
	Route::get('places/{id}', 'Api\PlaceController@show');

	Route::get('stations/search/{query}', 'Api\StationController@search');
	Route::get('stations/{id}', 'Api\StationController@show');

	Route::get('airports/search/{query}', 'Api\AirportController@search');
	Route::get('airports/{id}', 'Api\AirportController@show');

	// Route::resource('places', 'Api\PlaceController', ['only' => ['index', 'show']] );
});