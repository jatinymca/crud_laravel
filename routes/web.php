<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/home', [App\Http\Controllers\HomeController::class, 'delete_user'])->name('delete_user');
Route::post('/home', [App\Http\Controllers\HomeController::class, 'update_data_backend'])->name('update_data_backend');

Route::post('/update_data_backend',[UserController::class,'update_data_backend'])->name('update_data_backend');