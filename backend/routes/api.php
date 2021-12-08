<?php

use App\Http\Controllers\ApiFacade;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\TurnController;
use Illuminate\Support\Facades\Route;

//Route::apiResource('/table',TableController::class);

Route::apiResource('/usuario',UsuarioController::class);

Route::get('/waiter', [ApiFacade::class, 'showWaiter']);

ApiFacade::apiRoutesTurn();

ApiFacade::apiRoutesTable();
ApiFacade::apiRoutesQuerysWaiter();
