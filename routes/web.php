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
	Route::get('/person/create','ClientController@createPerson' );
	Route::post('/person','ClientController@storePerson' );
	Route::get('/person/{id}/edit','ClientController@editPerson' );
	Route::put('/person/{id}/update','ClientController@updatePerson' );

	Route::get('/company/create','ClientController@createCompany' );
	Route::post('/company','ClientController@storeCompany' );
	Route::get('/company/{id}/edit','ClientController@editCompany' );
	Route::put('/company/{id}/update','ClientController@updateCompany' );
Route::delete('/client/{id}/destroy','ClientController@destroy' );

//PDF
Route::get('pdf/order/{id}', 'PDFController@order' );
Route::get('pdf/proForma/{id}', 'PDFController@proForma' );

//home
Route::get('/home/sale','MenuController@sale' );

//API REST:
Route::get('/item/searchItem','ItemController@searchItem' ); //AJAX


Route::get('/bill','BillController@index' );
	Route::get('/bill/{idBillType}/create','BillController@create' );
	Route::post('/bill/{idBillType}/shipping_process','BillController@shipping_process' );

	Route::get('/bill/{idBillType}/items','BillController@items' );
	Route::post('/bill/{idBillType}/items_process','BillController@items_process' );

	Route::get('/bill/{idBillType}/receivedAmount','BillController@receivedAmount' );
	Route::post('/bill/{idBillType}/receivedAmount_process','BillController@receivedAmount_process' );

	Route::get('/bill/{idBillType}/client','BillController@client' );
	Route::post('/bill/{idBillType}/client_process','BillController@client_process' );

Route::get('/bill/{idBillType}/view','BillController@view' );
Route::delete('/bill/{idBillType}/destroy','BillController@destroy' );