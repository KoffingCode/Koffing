<?php

namespace Routes;

use App\Http\Controllers\QuerysWaiterController;
use Illuminate\Support\Facades\Route;


class QuerysWaiterApi
{
	public static function routesQuerysWaiter(){
		self::querysWaiter('/querysWaiter/waiter/{document}',"getWaiter");
		self::querysWaiter('/querysWaiter/turns/{document}',"getTurnsOfWaiter");
		self::querysWaiter('/querysWaiter/tables/{id}',"getTablesOfTurn");
		self::querysWaiter('/querysWaiter/waiterByUser/{id}',"getWaiterByUser");
	}

	private static function querysWaiter($route,$processName)
	{
		return Route::get($route,[QuerysWaiterController::class,$processName]);
	}
}
