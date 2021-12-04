<?php

namespace Routes;

use App\Http\Controllers\TableController;
use Illuminate\Support\Facades\Route;


class TablesApi
{
	public static function routesTable(){
		TablesApi::getOfTable('/table/{id}',"showTable");
		TablesApi::getOfTable('/tables',"showTables");
		TablesApi::getOfTable('/tablesOfTurn/{id}',"tablesOfTurn");
		TablesApi::storeTable('/table',"storeTable");
		TablesApi::updateTable('/table/{id}',"updateTable");
		TablesApi::destroyTable('/table/{id}',"destroyTable");
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
