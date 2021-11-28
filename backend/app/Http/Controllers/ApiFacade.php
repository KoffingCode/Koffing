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



	public static function showTables($route)
	{
		return Route::get($route,[TableController::class,"showTables"]);
	}
	public static function showTable($route)
	{
		return Route::get($route,[TableController::class,"showTable"]);
	}
	public static function storeTable($route)
	{
		return Route::post($route,[TableController::class,"storeTable"]);
	}
	public static function updateTable($route)
	{
		return Route::put($route,[TableController::class,"updateTable"]);
	}
	public static function destroyTable($route)
	{
		return Route::delete($route,[TableController::class,"destroyTable"]);
	}
}
