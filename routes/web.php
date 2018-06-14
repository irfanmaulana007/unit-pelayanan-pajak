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

Route::get('/', 'HomeController@index');
Route::get('login', 'AuthController@login');
Route::post('login', 'AuthController@doLogin');

Route::get('logout', 'AuthController@logout');


Route::get('monitoring', 'DocumentController@monitoring');
Route::post('find-document/{id}', 'DocumentController@findDocument');
Route::post('find-transaction/{id}', 'TransactionController@findTransaction');
Route::post('detail-transaction/{id}', 'TransactionController@detailTransaction');
Route::post('document/update/{id}', 'DocumentController@updateDocument');
Route::delete('document/{id}', 'DocumentController@deleteDocument');
Route::delete('transaction/{id}', 'TransactionController@deleteTransaction');

Route::resource('user', 'UserController');
Route::resource('role', 'RoleController');
Route::resource('document-status', 'DocumentStatusController');
Route::resource('company', 'CompanyController');


Route::post('find-kode/{kode}', 'DocumentController@findKode');
Route::get('document/input', 'DocumentController@input');
Route::post('document/input', 'DocumentController@createInput');
Route::post('transaction/receive/{id}', 'DocumentController@receiveDocument');
Route::post('transaction/passing/{id}', 'DocumentController@passingDocument');
Route::get('transaction/receive', 'DocumentController@receive');
Route::post('transaction/receive', 'DocumentController@acceptReceive');

Route::post('transaction/check-pending-document', 'TransactionController@checkPendingDocument');


Route::get('statistik', 'StatistikController@index');
Route::get('view-history', 'HistoryController@index');
Route::get('document/laporan', 'DocumentController@laporan');

