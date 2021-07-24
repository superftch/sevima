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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('covid')->group(function () {
    Route::get('all', 'ApiController@alldata');
    Route::get('vaksin', 'ApiController@vaksin');
});
Route::prefix('vaksin')->group(function () {
    Route::post('create', 'VaksinasiController@tambah');
    Route::get('detail/{id}','VaksinasiController@getdetail');
    Route::get('delete/{id}','VaksinasiController@delete');
    Route::post('edit','VaksinasiController@edit');
});
Route::get('provinsi','VaksinasiController@getprovinsi');
Route::get('kota/{id}','VaksinasiController@getkota');
Route::get('kecamatan/{id}','VaksinasiController@getkecamatan');
Route::get('kelurahan/{id}','VaksinasiController@getkelurahan');
