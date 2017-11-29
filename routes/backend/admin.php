<?php

Route::group(['prefix' => 'admin','middleware' => 'AdminAccess', 'namespace' => 'Backend'], function () {
    
    #-- Dashboard
    Route::group(['prefix' => 'dashboard', 'namespace' => 'Dashboard'], function () {
        Route::get('/', array('as' => 'admin.dashboard', 'uses' => 'DashboardController@index'));
    });
});