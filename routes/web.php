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

Route::get('/', 'MainController@index');
Route::get('/category/{category}', 'CategoryController@index');
Route::get('/add', 'MainController@addz');

Route::get('/api/getSort', 'CategoryController@sort');
Route::get('/api/getSearch', 'CategoryController@search');
Route::get('/api/getWorkers', 'CategoryController@getWorkers');

Route::post('/add', 'MainController@addw');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
