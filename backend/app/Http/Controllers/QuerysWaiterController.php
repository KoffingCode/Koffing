<?php

namespace App\Http\Controllers;

use App\Models\Waiter;
use App\Models\Turn;
use App\Models\Table;
use Illuminate\Http\Request;

// Mesero a partir de su documento
// Turnos correspondiente a ese mesero
// Mesas a partir de su turno

class QuerysWaiterController extends Controller
{
	public static function checkResponse($response)
	{
		if($response != null){
			return response()->json($response, 200);
		}else{
			return response()->json(['error' => 'Ningun registro encontrado'], 404);
		}
	}

	public static function getWaiter($document){
		$waiter = Waiter::where('document','=', $document)->first();
		return self::checkResponse($waiter);
	}

	public static function getTurnsOfWaiter($document){
		$waiter = Waiter::where('document','=', $document)->first();
		$turns = $waiter->turns()->get();
		return self::checkResponse($turns);
	}

	public static function getTablesOfTurn($id){
		$turn = Turn::find($id);
		$tables = $turn->tables()->get();
		return self::checkResponse($tables);
	}

	public static function getWaiterByUser($id){
		$waiter = Waiter::where('user_id', $id)->first();
		return $waiter;
	}
}