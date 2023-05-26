<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhotoController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/photos', [PhotoController::class, 'index']);
Route::post('/photos', [PhotoController::class, 'store'])->middleware('auth:sanctum');
Route::get('/photos/{id}', [PhotoController::class, 'show']);
Route::put('/photos/{id}', [PhotoController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/photos/{id}', [PhotoController::class, 'destroy'])->middleware('auth:sanctum');
Route::post('/photos/{id}/like', [PhotoController::class, 'like'])->middleware('auth:sanctum');
Route::post('/photos/{id}/unlike', [PhotoController::class, 'unlike'])->middleware('auth:sanctum');
