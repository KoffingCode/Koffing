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

	public function getWaiter($document){
		$waiter = Waiter::where('document','=', $document)->get();
		return response()->json($waiter, 200);
	}

	public function getTurnsOfWaiter($document){
		$waiter = $this->getWaiter($document)->get();
		$turns = $waiter->turns()->get();
		return response()->json($turns, 200);
	}

	public function getTablesOfTurn($id){
		$turn = Turn::find($id);
		$tables = $turn->tables()->get();
		return response()->json($tables, 200);
	}
}
