<?php

use App\Http\Controllers\TasksController;
use App\Http\Controllers\TelegramBotController;
use App\Http\Controllers\WeatherController;
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

Route::resource('tasks', TasksController::class)->middleware('auth');

Route::get('/weather', [WeatherController::class, 'index'])->name('weather.index');

Route::post('/telegram/bot', [TelegramBotController::class, 'handler'])->name('telegram.index');
