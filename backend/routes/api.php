<?php

use App\Http\Controllers\ApiFacade;
use App\Http\Controllers\UsuarioController;
use Routes\WaitersApi;
use Routes\TablesApi;
use Routes\QuerysWaiterApi;

use Illuminate\Support\Facades\Route;

include 'WaitersApi.php';
include 'TablesApi.php';
include 'QuerysWaiterApi.php';

//Route::apiResource('/table',TableController::class);

Route::apiResource('/usuario',UsuarioController::class);

//Route::get('/waiter', [ApiFacade::class, 'showWaiter']);


//Route::get('/waiter/{waiterId}', [ApiFacade::class, 'getWaiter']);

TablesApi::routesTable();
QuerysWaiterApi::routesQuerysWaiter();
WaitersApi::routesWaiter();
