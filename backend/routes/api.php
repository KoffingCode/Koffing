<?php

use App\Http\Controllers\ApiFacade;
use App\Http\Controllers\UsuarioController;
use Routes\WaitersApi;

use Illuminate\Support\Facades\Route;

include 'WaitersApi.php';
//Route::apiResource('/table',TableController::class);

Route::apiResource('/usuario',UsuarioController::class);

//Route::get('/waiter', [ApiFacade::class, 'showWaiter']);


//Route::get('/waiter/{waiterId}', [ApiFacade::class, 'getWaiter']);
ApiFacade::apiRoutesTable();
WaitersApi::routesTable();
