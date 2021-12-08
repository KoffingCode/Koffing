<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Http\Request;
use App\Models\Turn;
class TurnController extends Controller
{
    //https://stackoverflow.com/questions/38172857/how-to-select-specific-columns-in-laravel-eloquent

    public static function checkResponse($response,$exception)
	{
		if($exception->getMessage() != ""){
			return response()->json(['error' => $exception->getMessage()], 500);
		}else{
			return response()->json($response, 200);
		}
	}
    

    /**
     * Store a newly created turn in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeTurn(Request $request, Exception $exception)
    {
        Turn::create($request->all());
        return self::checkResponse($request->all(),$exception);
    }

    /**
     * Display the  turns.
     *
     * @param  \App\Models\Turn  $turn
     */
    public function showTurns(Exception $exception)
    {
        $listTurn =[];
        foreach(Turn::all() as $turn){
            array_push($listTurn, $turn);
        }
        return self::checkResponse($listTurn,$exception);
    }
    /**
     * Display the specified turn.
     *
     * @param  \App\Models\Turn  $turn
     */
    public function showTurn($id)
    {
        $turn = Turn::where("id", "=",$id)->first();
        if($turn != null){
            return response()->json($turn,200);
        }
        else{
            return response()->json(['error'=>'No turn found'],404);
        }
    }
    
    /**
     * Update the specified turn in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Turn  $turn
     * @return \Illuminate\Http\Response
     */
    public function updateTurn(Request $request, Exception $exception,$id)
    {
        $turn = Turn::where("id","=",$id)->fist();
        $turn->update($request->all());
        return self::checkResponse($turn,$exception);
    }

    /**
     * Remove the specified turn from storage .
     *
     * @param  \App\Models\Turn  $turn
     * @return \Illuminate\Http\Response
     */
    public function destroyTurn($id)
    {
        $turn = Turn::where("id","=",$id)->first();
        if($turn != null){
            $turn->delete();
            return response()->json($turn,200);
        }
        else{
            return response()->json(['error'=>"No turn found"]);
        }
    }
}
