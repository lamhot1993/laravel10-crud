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
Route::get('/',function(){
    return view('home');
});

Route::post('/get-users', [UserController::class, 'get']);
Route::post('/add-user', [UserController::class, 'add']);
Route::post('/update-user', [UserController::class, 'update']);
Route::post('/delete-user', [UserController::class, 'delete']);
Route::post('/login-user',[UserController::class,'login']);