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

Route::get('/', function () {
    return view('dashboard');
});

Auth::routes();

Route::get('/', 'Auth\LoginController@showLoginForm');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

//Route::get('/', 'HomeController@index')->name('home');

// Route::get('/', function(){
//     echo "Hello Depot-in-charge";
// })->middleware('depot');

// Route::group(['prefix' => 'user', 'middleware' => 'menu.user'], function () {
//     Route::get('dashboard', function () {
//         return view('welcome');
//     });
// });

Route::group(['prefix' => 'depot', 'middleware' => 'depot'], function () {
    Route::get('/', 'HomeController@index');

});