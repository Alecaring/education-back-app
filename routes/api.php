<?php

use App\Http\Controllers\Api\ApiDashboardController;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Api\ApiCoursesPageController;
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

Route::get('/corsi', [ApiCoursesPageController::class, 'index']);  // Elenco di tutti i corsi
Route::get('/corsi/{id}', [ApiCoursesPageController::class, 'show']);  // Dettagli di un singolo corso e relativi moduli
Route::get('/moduli/{id}/materiali', [ApiCoursesPageController::class, 'showMaterials']);  // Materiali di un modulo

Route::put('/materials/{id}/status', [ApiCoursesPageController::class, 'updateStatus']);

