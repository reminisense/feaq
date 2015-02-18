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

Route::get('/', 'UserController@getUserDashboard');

Route::post('/', 'UserController@processContactForm');

Route::controller('fb', 'FBController');

Route::controller('processqueue', 'ProcessQueueController');

Route::controller('user', 'UserController');

Route::controller('broadcast', 'BroadcastController');

Route::controller('processqueue', 'ProcessQueueController');

Route::controller('issuenumber', 'IssueNumberController');

Route::controller('queuesettings', 'QueueSettingsController');

Route::controller('business', 'BusinessController');

Route::controller('terminal', 'TerminalController');