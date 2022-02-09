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


Route::get('/records', [App\Http\Controllers\WelcomeController::class, 'saveApiData'])->name('fetch.data');
Route::get('/edit/{id}', [App\Http\Controllers\WelcomeController::class, 'edit'])->name('edit');
Route::post('/update', [App\Http\Controllers\WelcomeController::class, 'update'])->name('update');
Route::get('/delete/{id}', [App\Http\Controllers\WelcomeController::class, 'delete'])->name('delete');

Route::get('/', function () {
      return view('welcome');
});
