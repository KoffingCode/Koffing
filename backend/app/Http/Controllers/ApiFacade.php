<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;

class ApiFacade extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function storeWaiter(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showWaiter($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

	public static function apiRoutesTable(){
		ApiFacade::getOfTable('/table/{id}',"showTable");
		ApiFacade::getOfTable('/tables',"showTables");
		ApiFacade::getOfTable('/tablesOfTurn/{id}',"tablesOfTurn");
		ApiFacade::storeTable('/table',"storeTable");
		ApiFacade::updateTable('/table/{id}',"updateTable");
		ApiFacade::destroyTable('/table/{id}',"destroyTable");
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

	public static function apiRoutesQuerysWaiter(){
		ApiFacade::querysWaiter('/querysWaiter/waiter/{document}',"getWaiter");
		ApiFacade::querysWaiter('/querysWaiter/turns/{document}',"getTurnsOfWaiter");
		ApiFacade::querysWaiter('/querysWaiter/tables/{id}',"getTablesOfTurn");
	}

	public static function querysWaiter($route,$processName)
	{
		return Route::get($route,[QuerysWaiterController::class,$processName]);
	}

}
