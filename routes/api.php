<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthAdminController;

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


Route::post('/admin/register', [AuthAdminController::class, 'register']);
Route::post('/admin/login', [AuthAdminController::class, 'login']);
Route::post('/admin/logout', [AuthAdminController::class, 'logout'])->middleware('auth:admin');

Route::middleware('auth:admin')->group(function () {
    Route::apiResource('categories', CategoryController::class)->except(['show', 'update']);
    Route::apiResource('authors', AuthorController::class);
    Route::apiResource('books', BookController::class);
    Route::post('/order/{id}/status', [OrderController::class, 'changeStatus']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');

Route::middleware('auth:api')->group(function () {
    Route::post('/order', [OrderController::class, 'store'])->middleware('auth:api');
    Route::get('/getAllOrdersForUser', [OrderController::class, 'getAllOrdersForUser'])->middleware('auth:api');
});


