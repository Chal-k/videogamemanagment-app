<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\AuthController;
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
Route::get('/games', [GameController::class, 'allgames']);
Route::get('/games', [GameController::class, 'filterAndSort']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/games/mygames', [GameController::class, 'mygames']);
Route::post('/games/update', [GameController::class, 'updategame']);
Route::post('/games/create', [GameController::class, 'newgame']);
Route::get('/games/del', [GameController::class, 'deletemygame']);
});

    Route::post('/register', [AuthController::class, 'register']);  // Register
Route::post('/login', [AuthController::class, 'login']);  // Login

// Protected routes (Require authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);  // Logout
});
    

Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::get('/games/del', [GameController::class, 'deletegame']);
});



