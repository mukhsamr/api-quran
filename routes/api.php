<?php

use App\Http\Controllers\AyatController;
use App\Http\Controllers\QuranController;
use App\Http\Controllers\SuratController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller(QuranController::class)->group(function () {
    Route::get('surat', 'index');
    Route::get('surat/{surat}', 'surat');
    Route::get('juz', 'juz');
    Route::get('penanda', 'penanda');
    Route::get('penanda/{id}', 'penandaEdit');
    Route::get('ayat/{id}', 'ayat');
    Route::put('ayat/akhir', 'setAkhir');
    Route::put('ayat/penanda', 'setPenanda');
    Route::put('ayat/catatan', 'setCatatan');
    Route::put('ayat/catatan/edit', 'updateCatatan');
    Route::delete('ayat/catatan/{id}', 'deleteCatatan');
});
