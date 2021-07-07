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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::view('/senseData', 'senses.senseData')->name('senseData');
//Route::post('/senseData', [App\Http\Controllers\Api\SenseController::class, 'store']);

Route::view('/prueba', 'prueba');

Route::view('/chart', 'charts.senseCharts');

Route::get('/historic', [App\Http\Controllers\Api\SenseController::class, 'show'])->name('historic');
Route::post('/historic',[App\Http\Controllers\Api\SenseController::class, 'chart']);

Route::get('/event', [App\Http\Controllers\Api\SenseController::class, 'event'])->name('event');

Route::get('/filter', [App\Http\Controllers\Api\SenseController::class, 'chart'])->name('filter');

Route::resource('sensors', 'App\Http\Controllers\SensorController');





