<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::get('/dashboard', function () {
    return view('user.table');
})->middleware("auth:sanctum");


Route::get('/register', [App\Http\Controllers\API\AuthController::class,'index'])->name('register');
Route::get('/getUsers', [App\Http\Controllers\API\UserController::class,'index'])->name('user.table');