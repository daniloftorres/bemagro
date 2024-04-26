<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClimateWeatherController;
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

Route::middleware(['setLanguage'])->group(function () {
    Route::get('/', [ClimateWeatherController::class, 'fetchWeather']);
    Route::get('/list-weather', [ClimateWeatherController::class, 'listWeather']);
    Route::get('/edit-weather/{id}', [ClimateWeatherController::class, 'showEditWeatherForm']);
    Route::post('/edit-weather/{id}', [ClimateWeatherController::class, 'editWeather']);
    Route::delete('/delete-weather/{id}', [ClimateWeatherController::class, 'deleteWeather']);
});