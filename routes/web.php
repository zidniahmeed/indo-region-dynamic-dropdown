<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DaerahController;

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

Route::get('/', function () {
    return view('daerah');
});

Route::post('fetch-regency', [DaerahController::class, 'fetchregency']);
Route::post('fetch-district', [DaerahController::class, 'fetchdistrict']);
Route::post('fetch-village', [DaerahController::class, 'fetchvillage']);



