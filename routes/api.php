<?php

use App\Http\Controllers\TamagochiRegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/user/register', \TamagochiRegisterController::class . '@register');
Route::get('/user/get', \TamagochiRegisterController::class . '@getUser')->middleware('auth:api');
Route::post('/tamagochi/action', \TamagochiController::class . '@action')->middleware('auth:api');

