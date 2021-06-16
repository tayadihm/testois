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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', 'Auth\LoginController@login');

Route::post('logincard', 'Auth\LoginController@loginCard');

Route::group(['middleware' => 'auth:api'], function() {

    Route::get('showUser', 'API\APIController@showUser');

    Route::get('mahasiswa', 'API\APIController@showMhs');
    Route::get('mahasiswa/history_parkir', 'API\APIController@riwayatParkir');
    Route::get('mahasiswa/history_kantin', 'API\APIController@riwayatKantin');
    Route::get('mahasiswa/status_parkir', 'API\APIController@cekStatusKendaraan');
});