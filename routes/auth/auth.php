<?php

Route::group(['namespace' => 'Auth'], function () {
    
    #-- Admin Auth
    Route::group(['prefix' => 'admin', 'namespace' => 'Backend'], function () {
        Route::get('/login', array('as' => 'admin.login', 'uses' => 'AuthController@getLogin'));
        Route::post('/login', array('as' => 'admin.post.login', 'uses' => 'AuthController@postLogin'));
        
        Route::get('/logout', array('as' => 'admin.logout', 'uses' => 'AuthController@getLogout'));
    });
});