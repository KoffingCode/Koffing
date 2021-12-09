<?php

namespace App\Http\Controllers;

use App\Models\Waiter;
use Illuminate\Http\Request;

class WaiterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $waiters = Waiter::all()->toJson();
        return $waiters;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        Waiter::create($request->all());
        return response()->json($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Waiter  $waiter
     * @return \Illuminate\Http\Response
     */
    public function show(string $waiterId)
    {
        return response()->json(Waiter::find([$waiterId])->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Waiter  $waiter
     * @return \Illuminate\Http\Response
     */
    public function edit(Waiter $waiterId)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Waiter  $waiter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $waiterId)
    {
        Waiter::find([$waiterId])->first()->update($request->all());
        return response()->json(Waiter::find([$waiterId])->first());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Waiter  $waiter
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $waiterId)
    {
        $waiter = Waiter::find([$waiterId])->first();
        $waiter->delete();
        return response()->json($waiter);
    }
}
