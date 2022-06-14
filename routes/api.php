<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

    Route::resource('anuncio', App\Http\Controllers\AnuncioController::class)->except(['create', 'edit']);
    Route::post('subir', [App\Http\Controllers\AnuncioController::class, 'subir']);
    Route::post('subiranuncio', [App\Http\Controllers\AnuncioController::class, 'subiranuncio']);
    Route::get('fotos/{anuncio}', [App\Http\Controllers\AnuncioController::class, 'fotos']);
    Route::get('foto/{imagen}', [App\Http\Controllers\AnuncioController::class, 'foto']);
