<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsuarioController;


Route::apiResource('/usuario',UsuarioController::class);

Route::apiResource('/table',TableController::class);