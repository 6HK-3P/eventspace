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

Route::middleware(['admin'])->group(function (){
    //Админка Заказы
    Route::get('/admin/order', 'AdminOrderController@get_orders');
    Route::post('/admin/update_order/{id}/{action}', 'AdminOrderController@updateOrder');

    Route::get('/admin/order/check/{order_id}', 'AdminOrderController@check_order');
    //Админка Отзывы
    Route::get('/admin/feedback', 'AdminFeedbackController@feedback');
    Route::post('/add_feedback/{user_id}/{worker_id}', 'AdminFeedbackController@addFeedback');
    //Админка Смс
    Route::get('/admin/sms', 'AdminSmsController@sms');
    Route::post('/admin/sms/add', 'AdminSmsController@addsms');

    //Админка Пользователи
    Route::post('/admin/createMan', 'AdminUserController@addMan');
    Route::get('/admin/user', 'AdminUserController@user');
    //Админка Исполнители
    Route::get('/admin/workers', 'AdminWorkerController@selectworkers');
    Route::get('/admin/workers/{id}', 'AdminWorkerController@getWorkers');
    Route::get('/admin/workers/add/{cat}/{id}', 'AdminWorkerController@addz');
    Route::get('/admin/workers/addBusyDate/{id}', 'AdminWorkerController@addBusyDate');
    Route::get('/admin/workers/getBusyDates/{id}', 'AdminWorkerController@getBusyDates');
});

Auth::routes();
Route::get('/', 'MainController@index');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/category/{category}', 'CategoryController@index');


Route::get('/api/getSort', 'CategoryController@sort');
Route::get('/api/getSearch', 'CategoryController@search');
Route::get('/api/getpricetoday/{id}', 'ProductController@getPriceToday');
Route::get('/api/getWorkers', 'CategoryController@getWorkers');

//Админка мейн
Route::get('/admin', 'AdminController@index');
Route::post('/admin/add', 'AdminController@addteaser');
Route::post('/admin/head', 'AdminController@addhead');


Route::get('/admin/workers/getRulePrice/{id}', 'AdminWorkerController@getPriceRules');
Route::post('/admin/workers/add/{cat}/{id}', 'AdminWorkerController@addw');
Route::get('/admin/workers/add/{cat}/{id}/delete', 'AdminWorkerController@deleteWorker');
Route::post('/admin/workers/price_add/{id}', 'AdminWorkerController@pricing');
Route::post('/admin/workers/update_pricing/{id}', 'AdminWorkerController@updatePricing');
Route::post('/admin/workers/addlogo/{cat}/{id}', 'AdminWorkerController@addLogo');
Route::post('/admin/workers/addvideo/{cat}/{id}', 'AdminWorkerController@addVideo');
Route::post('/admin/workers/addaudio/{cat}/{id}', 'AdminWorkerController@addAudio');
Route::post('/admin/workers/addcar/{id}', 'AdminWorkerController@addCars');
Route::get('/admin/workers/getCars/{worker_id}', 'AdminWorkerController@getCars');
Route::get('/admin/workers/updateportfolio/{id}', 'AdminWorkerController@updatePortfolio');
Route::get('/admin/workers/addava/{id}', 'AdminWorkerController@addAva');
Route::get('/admin/workers/removeRulePrice/{id}', 'AdminWorkerController@removeRulePrice');

Route::get('/product/{id}', 'ProductController@index');

//Поиск по категории авто
Route::get('/category/{category}/find', 'CategoryController@sortFilters');
/*Цена продукта*/
Route::get('/{category}/pricing/{worker_id}/{param}', 'PricingController@getPricingInfo');

// обновление интервала
Route::get('/admin/interval/{cat}', 'SettingsController@getInterval');
Route::post('/admin/add_interval/{cat}', 'SettingsController@addInterval');

//заказ
Route::post('/orders/add/{id}', 'ProductController@addOrders');
//личный кабинет
Route::get('/lk/{cat}/{id}', 'AdminWorkerController@addz');
Route::get('/lk/', 'LkController@index');
Route::post('/lk/add_worker/{cat}/{id}', 'LkController@addWorker');
