<?php namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler {

	/**
	 * A list of the exception types that should not be reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		'Symfony\Component\HttpKernel\Exception\HttpException'
	];

	/**
	 * Report or log an exception.
	 *
	 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
	 *
	 * @param  \Exception  $e
	 * @return void
	 */
	public function report(Exception $e)
	{
		return parent::report($e);
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Exception  $e
	 * @return \Illuminate\Http\Response
	 */
	public function render($request, Exception $e) 
	{
		if ($request->is('api/*')) {
			if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException
				or $e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
				return app('api.response')->notFoundError('The requested resource does not exist.');
			}

			if ($e instanceof MethodNotAllowedException
				or $e instanceof MethodNotAllowedHttpException
				) {
				return $this->response()->setStatusCode(405)->error('The requested endpoint does not exist.');
			}

		}

		return parent::render($request, $e);
	}

}
