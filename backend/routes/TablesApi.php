<?php

namespace Routes;

use App\Http\Controllers\TableController;
use Illuminate\Support\Facades\Route;


class TablesApi
{
	public static function routesTable(){
		self::getOfTable('/table/{id}',"showTable");
		self::getOfTable('/tables',"showTables");
		self::getOfTable('/tablesOfTurn/{id}',"tablesOfTurn");
		self::storeTable('/table',"storeTable");
		self::updateTable('/table/{id}',"updateTable");
		self::destroyTable('/table/{id}',"destroyTable");
	}

	public static function getOfTable($route,$processName)
	{
		return Route::get($route,[TableController::class,$processName]);
	}
	public static function storeTable($route,$processName)
	{
		return Route::post($route,[TableController::class,$processName]);
	}
	public static function updateTable($route,$processName)
	{
		return Route::put($route,[TableController::class,$processName]);
	}
	public static function destroyTable($route,$processName)
	{
		return Route::delete($route,[TableController::class,$processName]);
	}

}
