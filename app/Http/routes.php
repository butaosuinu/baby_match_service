<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

// ユーザ登録
Route::get('signup', 'Auth\AuthController@getRegister')->name('signup.get');
Route::post('signup', 'Auth\AuthController@postRegister')->name('signup.post');
// ログイン
Route::get('login', 'Auth\AuthController@getLogin')->name('login.get');
Route::post('login', 'Auth\AuthController@postLogin')->name('login.post');
Route::get('logout', 'Auth\AuthController@getLogout')->name('logout.get');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('users', 'UsersController', ['only' => ['show']]);
    Route::group(['prefix' => 'users/{id}'], function () {
    	Route::get('contracts', 'UsersController@contracts')->name('users.contracts');
    	Route::post('contract', 'ContractsController@store')->name('user.contract');
    	Route::post('uncontract', 'ContractsController@destroy')->name('user.uncontract');
    });

    Route::resource('requests', 'RequestsController', ['only' => ['index', 'store', 'destroy']]);
});