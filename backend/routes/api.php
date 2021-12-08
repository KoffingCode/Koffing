<?php

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\TurnController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiFacade;
use Routes\WaitersApi;
use Routes\TablesApi;
use Routes\QuerysWaiterApi;

include 'WaitersApi.php';
include 'TablesApi.php';
include 'QuerysWaiterApi.php';

ApiFacade::apiRoutesTurn();

TablesApi::routesTable();
QuerysWaiterApi::routesQuerysWaiter();
WaitersApi::routesWaiter();
