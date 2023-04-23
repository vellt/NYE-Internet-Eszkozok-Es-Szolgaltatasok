<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FelhasznaloController;
use App\Http\Controllers\JogiDokumentumControler;

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
Route::post('/felhasznalok',[FelhasznaloController::class,'store']);
Route::get('/felhasznalok',[FelhasznaloController::class,'index']);
Route::get('/felhasznalok/{id}',[FelhasznaloController::class,'show']);
Route::post('/felhasznalok/{id}',[FelhasznaloController::class,'update']);
Route::delete('/felhasznalok/{id}',[FelhasznaloController::class,'delete']);
Route::post('/felhasznalok/{id}/ujjelszo', [FelhasznaloController::class,'updatePassword']);

Route::post('/jogi-dokumentumok/', [JogiDokumentumControler::class,'store']);
Route::get('/jogi-dokumentumok/', [JogiDokumentumControler::class,'index']);
Route::get('/jogi-dokumentumok/{utvonal}', [JogiDokumentumControler::class,'show']);
Route::post('/jogi-dokumentumok/{utvonal}', [JogiDokumentumControler::class,'update']);
Route::delete('/jogi-dokumentumok/{utvonal}', [JogiDokumentumControler::class,'delete']);


/*
Route::fallback( function () {
    abort( 404 );
} );
*/
