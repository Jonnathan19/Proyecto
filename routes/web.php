<?php

use App\Models\Sense;
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
    return view('welcome');
});

Auth::routes();

Route::get('sense', [App\Http\Controllers\SensorController::class, 'index'])->name('sense');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('event/{name}', [App\Http\Controllers\SensorController::class, 'event'])->name('event');

Route::resource('sensors', 'App\Http\Controllers\SensorController');

Route::get('/historic/{name}', [App\Http\Controllers\SensorController::class, 'id'])->name('id');
Route::post('/historic/{name}', [App\Http\Controllers\SensorController::class, 'filter'])->name('filter');



