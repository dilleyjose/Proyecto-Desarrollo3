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
	'as' => 'userd.index',
	'uses' => 'UsersController@index'
]);

Route::get('/users/api', 'UsersController@getUsers');
//Route::get('/users/api/clients_for_select', 'ClientsController@collectionForSelect');
Route::post('/users/api', 'UsersController@store');
Route::put('/users/api/{user_id}', 'UsersController@update');
Route::delete('/users/api/{client_id}', 'UsersController@destroy');
