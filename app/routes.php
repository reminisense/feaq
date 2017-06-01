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


Route::post('/', 'UserController@processContactForm');

Route::get('rest/register-user/{fb_id}/{first_name}/{last_name}/{email}/{gender}/{phone}/{country}',
  'RestController@getRegisterUser');

Route::get('forms/business/{business_id}', 'FormsController@getBusinessData');

Route::controller('fb', 'FBController');

Route::controller('processqueue', 'ProcessQueueController');

Route::controller('user', 'UserController');

Route::controller('rating', 'RatingController');

Route::controller('newsletter', 'NewsletterController');

Route::controller('broadcast', 'BroadcastController');

Route::controller('processqueue', 'ProcessQueueController');

Route::controller('issuenumber', 'IssueNumberController');

Route::controller('queuesettings', 'QueueSettingsController');

Route::controller('business', 'BusinessController');

Route::controller('terminal', 'TerminalController');

Route::controller('advertisement', 'AdvertisementController');

Route::controller('watchdog', 'WatchdogController');

Route::controller('rest', 'RestController'); /* RDH For Android Webservices*/

Route::controller('message', 'MessageController');

Route::controller('forms', 'FormsController');

Route::controller('admin', 'AdminController');

Route::get('about', 'ContentController@getMain');

Route::get('guides', 'ContentController@getGuides');

Route::controller('articles', 'ContentController');

Route::controller('how-to', 'ContentController');

Route::get('privacy', 'ContentController@getPrivacy');

Route::controller('test', 'TestController');

Route::controller('mobile', 'MobileController');

Route::controller('list', 'BusinessListController');

//services methods
Route::get('services/{id}', 'ServiceController@getIndex');

Route::get('services/business/{id}', 'ServiceController@getKioskServices');

Route::put('services/{id}', 'ServiceController@putIndex');

Route::delete('services/{id}', 'ServiceController@deleteIndex');

Route::controller('services', 'ServiceController');

//pacing methods
Route::controller('pacing', 'PacingController');

Route::controller('grouping', 'GroupingController');

// raw code and broadcast screen multiple groups selection
Route::get('/{raw_code?}/{templateId1?}/{templateId2?}/{templateId3?}/{templateId4?}/{templateId5?}/{templateId6?}/{templateId7?}/{templateId8?}/{templateId9?}/{templateId10?}/{templateId11?}/{templateId12?}/{templateId13?}/{templateId14?}/{templateId15?}/{templateId16?}',
  'UserController@getUserDashboard');

Route::controller('records', 'FormRecordController');

Route::controller('api', 'FreeApiController');