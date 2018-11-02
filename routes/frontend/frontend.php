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
    Route::get('/crew', array('as' => 'crew', 'uses' => 'CrewController@index'));
    Route::post('/contact-us', array('as' => 'contact.us', 'uses' => 'FormController@contactUs'));
    Route::post('/user-register', array('as' => 'user.register', 'uses' => 'FormController@userRegister'));
});

Route::group(['namespace' => 'Frontend', 'middleware' => 'MemberAccess'], function () {
    Route::get('/exercise', array('as' => 'exercise', 'uses' => 'ExerciseController@index'));
    Route::post('/exercise', array('as' => 'post.exercise', 'uses' => 'ExerciseController@post'));
});