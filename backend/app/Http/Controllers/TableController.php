<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;

class TableController extends Controller
{
    public static function showTables()
	{
		$listado = [];
		foreach (Table::all() as $usuario) {
			array_push($listado,$usuario);
		}
		return response()->json($listado, 200);
	}

    public static function showTable($id)
	{
		$table = Table::where("id","=",$id)->first();
		return response()->json($table, 200);
	}

    public static function tablesOfTurn($id)
	{
		$tables = Table::where("turn_id","=",$id)->get();
		return response()->json($tables, 200);
	}

	public static function storeTable(Request $request)
	{
		Table::create($request->all());
		return response("Storing resource");
	}

	public static function updateTable(Request $request,$id)
	{
		$table = Table::where("id","=",$id)->first();
		$table->update($request->all());
		return response()->json($table, 200);
	}

	public static function destroyTable($id)
	{
		$table = Table::where("id","=",$id)->first();
		$table->delete();
		return response()->json($table, 200);
	}
}
