<?php

namespace Routes;

use App\Http\Controllers\QuerysWaiterController;
use Illuminate\Support\Facades\Route;


class QuerysWaiterApi
{
	public static function routesQuerysWaiter(){
		QuerysWaiterApi::querysWaiter('/querysWaiter/waiter/{document}',"getWaiter");
		QuerysWaiterApi::querysWaiter('/querysWaiter/turns/{document}',"getTurnsOfWaiter");
		QuerysWaiterApi::querysWaiter('/querysWaiter/tables/{id}',"getTablesOfTurn");
	}

	public static function querysWaiter($route,$processName)
	{
		return Route::get($route,[QuerysWaiterController::class,$processName]);
	}
}
