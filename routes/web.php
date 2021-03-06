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
Route::get('/client/searchClientByDocumentNumber','ClientController@searchClientByDocumentNumber' ); //AJAX

//PDF
Route::get('pdf/printSale/{idSale}', 'PDFController@printSale' );
Route::get('pdf/printProForma/{idProForma}', 'PDFController@printProForma' );

//home
Route::get('/menu/sale','MenuController@sale' );
Route::get('/menu/dashBoard','MenuController@dashBoard' );
Route::get('/menu/shop','MenuController@shop' );

//API REST:
Route::get('/item/searchItem','ItemController@searchItem' ); //AJAX


Route::get('/bill','BillController@index' );
	Route::get('/bill/create','BillController@create' );
	Route::post('/bill/shipping_process','BillController@shipping_process' );

	Route::get('/bill/items','BillController@items' );
	Route::post('/bill/items_process','BillController@items_process' );

	Route::get('/bill/receivedAmount','BillController@receivedAmount' );
	Route::post('/bill/receivedAmount_process','BillController@receivedAmount_process' );

	Route::get('/bill/client','BillController@client' );
	Route::post('/bill/client_process','BillController@client_process' );
Route::get('/bill/{idBill}/view','BillController@view' );
Route::delete('/bill/{idBill}/destroy','BillController@destroy' );

Route::get('/bill/saleMonth','BillController@saleMonth' ); //AJAX


Route::get('/sale','SaleController@index' );
	Route::get('/sale/zone','SaleController@zone' ); //items
	Route::post('/sale/zone_process','SaleController@zone_process' );
	Route::get('/sale/items','SaleController@items' );
	Route::post('/sale/items_process','SaleController@items_process' );

	Route::get('/sale/amounts','SaleController@amounts' );
	Route::post('/sale/amounts_process','SaleController@amounts_process' );

	Route::get('/sale/payment','SaleController@payment' );
	Route::post('/sale/payment_process','SaleController@payment_process' );

	Route::get('/sale/client','SaleController@client' );
	Route::post('/sale/client_process','SaleController@client_process' );

	Route::get('/sale/voucher','SaleController@voucher' );
	Route::post('/sale/voucher_process','SaleController@voucher_process' );

	Route::get('/sale/shipping','SaleController@shipping' );
	Route::post('/sale/shipping_process','SaleController@shipping_process' );
Route::get('/sale/{idSale}/view','SaleController@view' );
Route::delete('/sale/{idSale}/destroy','SaleController@destroy' );

Route::get('/sale/saleMonth','SaleController@saleMonth' ); //AJAX

Route::get('/proForma','ProFormaController@index' );
	Route::get('/proForma/zone','ProFormaController@zone' ); //items
	Route::post('/proForma/zone_process','ProFormaController@zone_process' );
	Route::get('/proForma/items','ProFormaController@items' );
	Route::post('/proForma/items_process','ProFormaController@items_process' );

	Route::get('/proForma/amounts','ProFormaController@amounts' );
	Route::post('/proForma/amounts_process','ProFormaController@amounts_process' );
Route::get('/proForma/{idProForma}/view','ProFormaController@view' );
Route::delete('/proForma/{idProForma}/destroy','ProFormaController@destroy' );