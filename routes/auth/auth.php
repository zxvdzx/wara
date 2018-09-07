<?php

Route::group(['namespace' => 'Auth'], function () {
    
    #-- Admin Auth
    Route::group(['prefix' => 'admin', 'namespace' => 'Backend'], function () {
        Route::get('/login', array('as' => 'admin.login', 'uses' => 'AuthController@getLogin'));
        Route::post('/login', array('as' => 'admin.post.login', 'uses' => 'AuthController@postLogin'));
        
        Route::get('/logout', array('as' => 'admin.logout', 'uses' => 'AuthController@getLogout'));
    });
    Route::group(['prefix' => 'auth', 'namespace' => 'Backend'], function () {
        Route::post('/login-member', array('as' => 'member.post.login', 'uses' => 'AuthController@postLoginMember'));
        Route::get('/activation-user/{id}/{code}', array('as' => 'activation-user', 'uses' => 'AuthController@activationUser'));
    });
});