<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Table;
use App\Models\Turn;

class TableController extends Controller
{
	public static function checkResponse($response,$exception)
	{
		if($exception->getMessage() != ""){
			return response()->json(['error' => $exception->getMessage()], 500);
		}else{
			return response()->json($response, 200);
		}
	}
	
    public static function showTables(Exception $exception)
	{
		$listado = [];
		foreach (Table::all() as $usuario) {
			array_push($listado,$usuario);
		}
		return self::checkResponse($listado,$exception);
	}

    public static function showDataTurns(Exception $exception)
	{
		$listado = [];
		foreach (Turn::select('id','date','startingHour','endingHour')->get() as $turn) {
			array_push($listado,$turn);
		}
		return self::checkResponse($listado,$exception);
	}

    public static function showTable($id)
	{
		$table = Table::where("id","=",$id)->first();
		if($table != null){
			return response()->json($table, 200);
		}else{
			return response()->json(['error' => 'No se encontró la mesa'], 404);
		}
	}

    public static function tablesOfTurn($id)
	{
		$tables = Table::where("turn_id","=",$id)->get();
		return response()->json($tables, 200);
	}

	public static function storeTable(Request $request,Exception $exception)
	{
		Table::create($request->all());
		$nuevo = Table::latest()->first();
		return self::checkResponse($nuevo,$exception);
	}

	public static function updateTable(Request $request,$id,Exception $exception)
	{
		$table = Table::where("id","=",$id)->first();
		$table->update($request->all());
		return self::checkResponse($table,$exception);
	}

	public static function destroyTable($id)
	{
		$table = Table::where("id","=",$id)->first();
		if($table != null){
			$table->delete();
			return response()->json($table, 200);
		}else{
			return response()->json(['error' => 'No se encontró la mesa'], 404);
		}
	}
}
