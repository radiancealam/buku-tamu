<?php

use App\Http\Controllers\GuestsController;
use App\Http\Controllers\PagesController;
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

Route::get('/', [GuestsController::class, 'index']);
Route::post('/', [GuestsController::class, 'store']);
Route::put('/{guest}', [GuestsController::class, 'update']);
Route::delete('/{guest}', [GuestsController::class, 'destroy']);
Route::get('/export-data', [GuestsController::class, 'exportData']);
