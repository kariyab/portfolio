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
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'can:admin-higher']], function () {
    Route::get('bbs/create', 'Admin\BbsController@add');
    Route::post('bbs/create', 'Admin\BbsController@create');
    Route::get('bbs', 'Admin\BbsController@index');
    
    Route::get('bbs/edit', 'Admin\BbsController@edit');
    Route::post('bbs/edit', 'Admin\BbsController@update');
    Route::get('bbs/delete', 'Admin\BbsController@delete');

    
    Route::get('profile/create', 'Admin\ProfileController@add');
    Route::post('profile/create', 'Admin\ProfileController@create');
    Route::get('profile', 'Admin\ProfileController@index');
    
    Route::get('profile/edit', 'Admin\ProfileController@edit');
    Route::post('profile/edit', 'Admin\ProfileController@update');
    Route::get('profile/delete', 'Admin\ProfileController@delete');
    
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'BbsController@index');
Route::get('profile', 'ProfileController@index');

Route::get('bbs/create', 'User\BbsController@add');
Route::post('bbs/create', 'User\BbsController@create');
Route::get('bbs', 'User\BbsController@index');

Route::get('bbs/edit', 'User\BbsController@edit');
Route::post('bbs/edit', 'User\BbsController@update');
Route::get('bbs/delete', 'User\BbsController@delete');

Route::get('user', 'UserController@index');

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function() {
    Route::get('myprofile', 'User\ProfileController@add');
    Route::post('myprofile/edit', 'User\ProfileController@update');
    Route::get('myprofile/delete', 'User\ProfileController@delete');

});