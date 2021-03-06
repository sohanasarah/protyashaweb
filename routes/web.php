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

// Route::get('/', function () {
//     return view('dashboard');
// });

Auth::routes();

Route::get('/', 'Auth\LoginController@showLoginForm');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

//Route::get('/', 'HomeController@index');


Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/admin', 'admin\DashboardController@index');
});

Route::group(['middleware' => ['auth', 'depot']], function () {
    Route::get('/depot', 'depot\DashboardController@index');
    Route::get('/depot/order_list', 'depot\DashboardController@orders');
    Route::get('/depot/item_list', 'depot\DashboardController@items');
});

Route::group(['middleware' => ['auth', 'division']], function () {
    Route::get('/division', 'division\DashboardController@index');
    Route::get('/division/order_list', 'division\DashboardController@orders');
    Route::get('/division/item_list', 'division\DashboardController@items');
    Route::get('/division/order_list/{id}', 'division\DashboardController@close_orders');
});

Route::group(['middleware' => ['auth', 'marketing']], function () {
    Route::get('/marketing', 'marketing\DashboardController@index');
});