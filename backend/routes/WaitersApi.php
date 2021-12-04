<?php

namespace Routes;

use App\Http\Controllers\WaiterController;
use App\Models\Waiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Mesero a partir de su documento
// Turnos correspondiente a ese mesero
// Mesas a partir de su turno

class WaitersApi
{
	public static function routesTable()
	{
		WaitersApi::getWaiters();
		WaitersApi::getWaiter();
		WaitersApi::postWaiter();
		WaitersApi::updateWaiter();
		WaitersApi::deleteWaiter();
	}

	public static function getWaiters()
	{
		return Route::get('waiters/', [WaiterController::class, 'index']);
	}

	public static function getWaiter()
	{
		return Route::get('waiters/{waiterDocument}', [WaiterController::class, 'show']);
	}

	public static function postWaiter()
	{
		return Route::post('waiters/', [WaiterController::class, 'store']);
	}

	public static function updateWaiter()
	{
		return Route::put('waiters/{waiterDocument}', [WaiterController::class, 'update']);
	}

	public static function deleteWaiter()
	{
		return Route::delete('waiters/{waiterDocument}', [WaiterController::class, 'destroy']);
	}
	//Route
	/*
	public function getWaiters()
	{
		return response()->json('', 200);
	}

	public function getWaiter($document)
	{
		$waiter = Waiter::where('document','=', $document)->get();
		return response()->json($waiter, 200);
	}

	public function getTurnsOfWaiter($document)
	{
		$waiter = $this->getWaiter($document)->get();
		$turns = $waiter->turns()->get();
		return response()->json($turns, 200);
	}

	public function getTablesOfTurn($id)
	{
		$turn = Turn::find($id);
		$tables = $turn->tables()->get();
		return response()->json($tables, 200);
	}*/
}
