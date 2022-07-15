<?php

use App\Http\Controllers\Api\UserController;
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

/* Route::middleware('api')->get('/user', function (Request $request) {
    return response()->json(['user' => $request->user()]);
}); */

Route::middleware('auth:api')->group(function () {
    Route::get('user', [UserController::class , 'get']);
    Route::post('updateinfo', [UserController::class , 'updateinfo']);
});

Route::post('login', [UserController::class , 'login']);
Route::post('register', [UserController::class , 'register']);
Route::get('list', [UserController::class , 'list']);
