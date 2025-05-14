<?php

use App\Http\Controllers\API\TodoController;
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

Route::apiResource('todos', TodoController::class);

// Route::prefix('v1')->group(function () {
//     Route::get('pentest', [ApiController::class, 'pentest']);
// });

// use App\Http\Controllers\API\TodoController;

// Route::middleware('auth.bearer')->group(function () {
//     Route::apiResource('todos', TodoController::class);
// });
