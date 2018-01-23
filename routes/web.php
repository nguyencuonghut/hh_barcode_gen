<?php

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

Route::get('/', function () {
    return redirect()->route('barcode.create');
});
Route::resource('/barcode', 'BarcodeController');
Route::get('/barcode/print/{id}', ['uses' => 'BarcodeController@barcodePrint', 'as' => 'barcode.print']);
Route::get('/barcode/export/{id}', ['uses' => 'BarcodeController@export', 'as' => 'barcode.export'] );
Route::post('/client/import', ['uses' => 'ClientsController@import', 'as' => 'client.import'] );
Route::get('/client/data', ['uses' => 'ClientsController@anyData', 'as' => 'client.data'] );
