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
	/*
	if (!Auth::check())
	{
		return View::make('page-front');
	}
	else {
		$role = Role::roleId(Auth::user()->user_id);
		if ($role == REMINISENSE) {
			return View::make('user.dashboard')
				->with('title', 'Dashboard')
				->with('header_title', 'FeatherQ Dashboard')
				->with('businesses', DashboardController::businessesBranchesServices());
		}
		elseif ($role == BUSINESS_OWNER || $role == IT_ADMIN) {
			return View::make('user.dashboard')
				->with('title', 'Dashboard')
				->with('header_title', Business::businessName(Business::getBusinessIdByOwner(Auth::user()->user_id)) . ' / Dashboard')
				->with('businesses', DashboardController::businessesBranchesServices(Business::getBusinessIdByOwner(Auth::user()->user_id)))
				->with('role', $role);
		}
		elseif ($role == TERMINAL_ADMIN || $role == QUEUE_ADMIN) {
			$hooked_terminal = 0;
			$user = Auth::user()->user_id;
			if (TerminalOpsController::userIsHooked($user)) {
				$hooked_terminal = TerminalTransaction::hookedTerminal($user);
			}

			return View::make('terminal.dashboard')
				->with('userIsHooked', TerminalOpsController::userIsHooked($user))
				->with('hookedTerminal', $hooked_terminal)
				->with('terminalsArray', TerminalController::terminalsInService($user));
		} else {
			return View::make('user.dashboard')
				->with('title', 'Dashboard')
				->with('header_title', 'Dashboard');
		}
	}
	*/
});

Route::controller('fb', 'FBController');

Route::controller('processqueue', 'ProcessQueueController');

function _renderFrontView($session = NULL)
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