<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
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


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('/upload', [FileController::class, 'upload']);
    Route::get('/files', [FileController::class, 'index'])->middleware('permission:view_own_files|view_all_files');
    Route::delete('/files/{id}', [FileController::class, 'destroy'])->middleware('permission:delete_own_files|delete_user_files|delete_all_files');
});
