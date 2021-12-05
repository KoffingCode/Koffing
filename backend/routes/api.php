<?php

use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

use Routes\WaitersApi;
use Routes\TablesApi;
use Routes\QuerysWaiterApi;

include 'WaitersApi.php';
include 'TablesApi.php';
include 'QuerysWaiterApi.php';


TablesApi::routesTable();
QuerysWaiterApi::routesQuerysWaiter();
WaitersApi::routesWaiter();
