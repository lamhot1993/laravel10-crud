<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/users', [UserController::class, 'get']);
Route::post('/users', [UserController::class, 'add']);
Route::post('/update-user', [UserController::class, 'update']);
Route::post('/delete-user', [UserController::class, 'delete']);