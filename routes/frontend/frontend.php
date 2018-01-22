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

Route::group(['namespace' => 'Frontend'], function () { 
    Route::get('/', array('as' => 'dashboard', 'uses' => 'DashboardController@index'));
    Route::post('/postSignup', array('as' => 'user.signup', 'uses' => 'AuthController@signup'));
});
