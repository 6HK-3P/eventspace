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


Route::get('/api/getSort', 'CategoryController@sort');
Route::get('/api/getSearch', 'CategoryController@search');
Route::get('/api/getWorkers', 'CategoryController@getWorkers');

//Админка мейн
Route::get('/admin', 'AdminController@index');
Route::post('/admin/add', 'AdminController@addteaser');
Route::post('/admin/head', 'AdminController@addhead');
//Админка Пользователи
Route::post('/admin/createMan', 'AdminUserController@addMan');
Route::get('/admin/user', 'AdminUserController@user');
//Админка Исполнители
Route::get('/admin/workers', 'AdminWorkerController@selectworkers');
Route::get('/admin/workers/{id}', 'AdminWorkerController@getWorkers');
Route::get('/admin/workers/add/{cat}/{id}', 'AdminWorkerController@addz');
Route::get('/admin/workers/getRulePrice/{id}', 'AdminWorkerController@getPriceRules');
Route::post('/admin/workers/add/{cat}/{id}', 'AdminWorkerController@addw');
Route::get('/admin/workers/add/{cat}/{id}/delete', 'AdminWorkerController@deleteWorker');
Route::post('/admin/workers/price_add/{id}', 'AdminWorkerController@pricing');
Route::post('/admin/workers/update_pricing/{id}', 'AdminWorkerController@updatePricing');
//Админка Заказы
Route::get('/admin/order', 'AdminOrderController@order');
//Админка Отзывы
Route::get('/admin/feedback', 'AdminFeedbackController@feedback');
//Админка Смс
Route::get('/admin/sms', 'AdminSmsController@sms');
Route::post('/admin/sms/add', 'AdminSmsController@addsms');

Route::get('/product/{id}', 'ProductController@index');

Auth::routes();