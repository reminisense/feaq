<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return _renderFrontView();
});

Route::controller('fb', 'FBController');

Route::controller('processqueue', 'ProcessQueueController');

Route::controller('user', 'UserController');

Route::controller('broadcast', 'BroadcastController');

function _renderFrontView()
{
	if (Auth::check())
	{
		return View::make('dashboard');
	}
	else
	{
		return View::make('page-front');
	}
}