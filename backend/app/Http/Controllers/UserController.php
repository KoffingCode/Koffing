<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Users = User::all()->toJson();
        return $Users;
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
        User::create($request->all());
        //return response()->json($request);
        return response()->json(User::where('email', $request->input('email'))->first());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     *//*
    public function show(string $userId)
    {
        return response()->json(User::find([$userId])->first());
    }*/

    public function show(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        return response()->json(User::where('email', $email)->first());
        //return response()->json(User::find([$request->all()])->first());
    }

    public function showById(string $id)
    {
        return response()->json(User::find([$id])->first());
        //return response()->json(User::find([$request->all()])->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function edit(User $userId)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $userId)
    {
        User::find([$userId])->first()->update($request->all());
        return response()->json(User::find([$userId])->first());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $userId)
    {
        $User = User::find([$userId])->first();
        $User->delete();
        return response()->json($User);
    }
}
