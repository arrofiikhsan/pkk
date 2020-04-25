<?php

use Illuminate\Http\Request;

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
Route::post('register', 'admincontroller@register');
Route::post('login', 'admincontroller@login');
// member
Route::post('simpan','membercontroller@tambah')->middleware('jwt.verify');
Route::post('update/{id}','membercontroller@update')->middleware('jwt.verify');
Route::post('delete/{id}','membercontroller@destroy')->middleware('jwt.verify');
Route::get('show','membercontroller@show')->middleware('jwt.verify');
// barang
Route::post('tambah','barangcontroller@tambah')->middleware('jwt.verify');
Route::post('updatebarang/{id}','barangcontroller@update')->middleware('jwt.verify');
Route::post('deletebarang/{id}','barangcontroller@destroy')->middleware('jwt.verify');
Route::get('showw/{id}','barangcontroller@show')->middleware('jwt.verify');
// transaksi
Route::post('transaksi', 'transaksicontroller@tambah')->middleware('jwt.verify');
Route::post('showtransaksi/{id}', 'transaksicontroller@show')->middleware('jwt.verify');
Route::delete('transaksi/{id}', 'transaksicontroller@show')->middleware('jwt.verify');
Route::post('konftransaksi/{id}', 'transaksicontroller@konfirmasi_transaksi')->middleware('jwt.verify');
