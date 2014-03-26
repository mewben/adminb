<?php

/*
|--------------------------------------------------------------------------
| Register The Laravel Class Loader
|--------------------------------------------------------------------------
|
| In addition to using Composer, you may use the Laravel class loader to
| load your controllers and models. This is useful for keeping all of
| your classes in the "global" namespace without Composer updating.
|
*/

ClassLoader::addDirectories(array(

	app_path().'/commands',
	app_path().'/controllers',
	app_path().'/models',
	app_path().'/database/seeds',

));

/*
|--------------------------------------------------------------------------
| Application Error Logger
|--------------------------------------------------------------------------
|
| Here we will configure the error logger setup for the application which
| is built on top of the wonderful Monolog library. By default we will
| build a basic log file setup which creates a single file for logs.
|
*/

Log::useFiles(storage_path().'/logs/laravel.log');

/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
*/
/*
App::error(function(Illuminate\Database\QueryException $exception, $code)
{
	switch ($exception->getCode()) {
		case 23505:
			return Response::json('Database error! The input you entered already exists in the database.', 400);
			break;
		case 23503:
			return Response::json('Database error! You cannot delete this item as it is used in another table.', 400);
			break;
		default:
			return Response::json("Database error! Error code: " . $exception->getCode(), 400);
			break;
	}
});
*/

App::error(function(Exception $exception, $code)
{
	if ($code == 404) {
		return Response::json('Resource not found.', $code);
	} elseif (gettype( $r = json_decode($exception->getMessage()) )  === 'object') {
		return Response::json($r, 400);
	} elseif ($exception->getCode() == 409) {
		return Response::json($exception->getMessage(), 400);
	} else {
		//Log::error($exception);
		//return Response::json($exception->getMessage(), 500);
	}
});

/*
|--------------------------------------------------------------------------
| Maintenance Mode Handler
|--------------------------------------------------------------------------
|
| The "down" Artisan command gives you the ability to put an application
| into maintenance mode. Here, you will define what is displayed back
| to the user if maintenance mode is in effect for the application.
|
*/

App::down(function()
{
	return Response::make("Be right back!", 503);
});

/*
|--------------------------------------------------------------------------
| Require The Filters File
|--------------------------------------------------------------------------
|
| Next we will load the filters file for the application. This gives us
| a nice separate location to store our route and application filter
| definitions instead of putting them all in the main routes file.
|
*/

require app_path().'/filters.php';
