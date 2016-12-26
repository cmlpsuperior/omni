<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/','LoginController@index' );
Route::post('/authenticate','LoginController@authenticate' );
Route::get('/logout','LoginController@logout' );

Route::get('/employee','EmployeeController@index' );
Route::get('/employee/create','EmployeeController@create' );
Route::post('/employee','EmployeeController@store' );
Route::get('/employee/{id}/edit','EmployeeController@edit' );
Route::put('/employee/{id}/update','EmployeeController@update' );
Route::delete('/employee/{id}/destroy','EmployeeController@destroy' );

Route::get('/zone','ZoneController@index' );
Route::get('/zone/create','ZoneController@create' );
Route::post('/zone','ZoneController@store' );
Route::get('/zone/{id}/edit','ZoneController@edit' );
Route::put('/zone/{id}/update','ZoneController@update' );
Route::delete('/zone/{id}/destroy','ZoneController@destroy' );

Route::get('/item','ItemController@index' );
Route::get('/item/create','ItemController@create' );
Route::post('/item','ItemController@store' );
Route::get('/item/{id}/edit','ItemController@edit' );
Route::put('/item/{id}/update','ItemController@update' );
Route::delete('/item/{id}/destroy','ItemController@destroy' );

Route::get('/client','ClientController@index' );
Route::get('/client/create','ClientController@create' );
Route::post('/client','ClientController@store' );
Route::get('/client/{id}/edit','ClientController@edit' );
Route::put('/client/{id}/update','ClientController@update' );
Route::delete('/client/{id}/destroy','ClientController@destroy' );

Route::get('/order','OrderController@index' );
Route::get('/order/create','OrderController@create' );
	Route::post('/order/clientInfo_process','OrderController@clientInfo_process' );
	Route::get('/order/items','OrderController@items' );
	Route::post('/order/items_process','OrderController@items_process' );
Route::post('/order','OrderController@store' );
Route::get('/order/{id}/edit','OrderController@edit' );
Route::put('/order/{id}/update','OrderController@update' );
Route::delete('/order/{id}/destroy','OrderController@destroy' );