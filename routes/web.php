<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivitiesController;
use App\Http\Controllers\MethodsController;

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

Route::get('/activities', [ActivitiesController::class, 'index']);
Route::get('/activities/details/{id}', [ActivitiesController::class, 'show']);
Route::post('/activities', [ActivitiesController::class, 'store']);
Route::put('/activities/{id}', [ActivitiesController::class, 'update']);
Route::delete('/activities/delete/{id}', [ActivitiesController::class, 'destroy']);
Route::get('/activities/table', [ActivitiesController::class, 'table']);

