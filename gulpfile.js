var elixir = require('laravel-elixir');

/*
|--------------------------------------------------------------------------
| Elixir Asset Management
|--------------------------------------------------------------------------
|
| Elixir provides a clean, fluent API for defining some basic Gulp tasks
| for your Laravel application. By default, we are compiling the Less
| file for our application, as well as publishing vendor resources.
|
*/

elixir(function(mix) {

	mix.less('app.less')
	.version('css/app.css');

	mix.scripts([
		'jquery/dist/jquery.min.js',
		'selectize/js/selectize.min.js',
		], 'public/js/vendor.js', 'resources/bower')
	.version('js/vendor.js');

	mix.scripts([
		'app.js',
		], 'public/js/app.js')
	.version('js/app.js');

});
