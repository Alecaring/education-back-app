<?php

use App\Http\Controllers\Api\ApiDashboardController;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




// Rotta per la richiesta di login
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Rotta per la richiesta di logout (distruzione della sessione)
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth:sanctum');

Route::resource('dashboard', ApiDashboardController::class);


