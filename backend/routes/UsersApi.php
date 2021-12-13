<?php

namespace Routes;

use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Mesero a partir de su documento
// Turnos correspondiente a ese mesero
// Mesas a partir de su turno

class UsersApi
{
	public static function routesUser()
	{
		self::getUsers();
		self::getUser();
		self::getUserById();
		self::postUser();
		self::updateUser();
		self::deleteUser();
	}

	public static function getUsers()
	{
		return Route::get('Users/', [UserController::class, 'index']);
	}

	public static function getUser()
	{
		return Route::post('user/', [UserController::class, 'show']);
	}

	public static function getUserById()
	{
		return Route::get('user/{id}', [UserController::class, 'showById']);
	}

	public static function postUser()
	{
		return Route::post('users/', [UserController::class, 'store']);
	}

	public static function updateUser()
	{
		return Route::put('users/{userId}', [UserController::class, 'update']);
	}

	public static function deleteUser()
	{
		return Route::delete('users/{userId}', [UserController::class, 'destroy']);
	}
}