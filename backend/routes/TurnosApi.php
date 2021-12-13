<?php

namespace Routes;

use App\Http\Controllers\TurnController;
use Illuminate\Support\Facades\Route;


class TurnosApi
{

public static function routesTurn(){
		self::getOfTurn('/turn/{id}',"showTurn");
		self::getOfTurn('/turns',"showTurns");
		self::storeTurn('/turn',"storeTurn");
		self::updateTurn('/turn/{id}',"updateTurn");
		self::destroyTurn('/turn/{id}',"destroyTurn");
		self::getOfTurn('/turnoMeseros/{id}',"getWaiters");
		
	}

    public static function getOfTurn($route,$processName)
	{
		return Route::get($route,[TurnController::class,$processName]);
	}
	public static function storeTurn($route,$processName)
	{
		return Route::post($route,[TurnController::class,$processName]);
	}
	public static function updateTurn($route,$processName)
	{
		return Route::put($route,[TurnController::class,$processName]);
	}
	public static function destroyTurn($route,$processName)
	{
		return Route::delete($route,[TurnController::class,$processName]);
	}
}