<?php

use App\Http\Controllers\ApiFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TableController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\WaiterController;

//Route::apiResource('/table',TableController::class);

//Route::apiResource('/usuario',UsuarioController::class);

Route::get('/waiter', [ApiFacade::class, 'showWaiter']);