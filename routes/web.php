<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/test', function () {
    return view('test');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users',[
	'as' => 'users.index',
	'uses' => 'UsersController@index'
]);

Route::get('/users/api', 'UsersController@getUsers');
//Route::get('/users/api/clients_for_select', 'ClientsController@collectionForSelect');
Route::post('/users/api', 'UsersController@store');
Route::put('/users/api/{user_id}', 'UsersController@update');
Route::delete('/users/api/{client_id}', 'UsersController@destroy');


Route::get('/clients',[
	'as' => 'clients.index',
	'uses' => 'ClientsController@index'
]);

Route::get('/clients/api', 'ClientsController@getClients');
Route::post('/clients/api', 'ClientsController@store');
Route::put('/clients/api/{client_id}', 'ClientsController@update');
Route::delete('/clients/api/{client_id}', 'ClientsController@destroy');

Route::get('/suppliers',[
	'as' => 'suppliers.index',
	'uses' => 'SuppliersController@index'
]);

Route::get('/suppliers/api', 'SuppliersController@getSuppliers');
Route::post('/suppliers/api', 'SuppliersController@store');
Route::put('/suppliers/api/{supplier_id}', 'SuppliersController@update');
Route::delete('/suppliers/api/{supplier_id}', 'SuppliersController@destroy');

Route::get('/products',[
	'as' => 'products.index',
	'uses' => 'ProductsController@index'
]);

Route::get('/products/api', 'ProductsController@getProducts');
Route::post('/products/api', 'ProductsController@store');
Route::put('/products/api/{product_id}', 'ProductsController@update');
Route::delete('/products/api/{product_id}', 'ProductsController@destroy');

Route::get('/invoices',[
	'as' => 'invoices.index',
	'uses' => 'InvoicesController@index'
]);

Route::get('/invoices/controlInvoices',[
	'as' => 'invoices.controlInvoices',
	'uses' => 'InvoicesController@controlInvoices'
]);

Route::post('/invoices/api', 'InvoicesController@store');
Route::delete('/invoices/api/{invoice_id}', 'InvoicesController@destroy');

Route::post('/invoiceItems/api', 'InvoicesController@storeItem');
Route::delete('/invoiceItems/api/{item_id}', 'InvoicesController@destroyItem');

Route::get('invoices/api/getInvoices', 'InvoicesController@getInvoices');


