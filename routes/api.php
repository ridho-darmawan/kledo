<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\GajiPegawaiController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post(
    '/gaji-pegawai/batch',
    [GajiPegawaiController::class, 'batchGajiPegawai']
)->name('gaji-pegawai.batch');

Route::post(
    '/gaji-pegawai/filter',
    [GajiPegawaiController::class, 'index']
)->name('gaji-pegawai.filter');



Route::resource('gaji-pegawai', GajiPegawaiController::class);
Route::resource('pegawai', PegawaiController::class);
