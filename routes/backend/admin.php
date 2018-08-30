<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Backend', 'middleware' => 'AdminAccess'], function () {
    
    #-- Dashboard
    Route::group(['prefix' => 'dashboard', 'namespace' => 'Dashboard'], function () {
        Route::get('/', array('as' => 'admin.dashboard', 'uses' => 'DashboardController@index'));
    });

    #-- Question Category
    Route::group(['prefix' => 'category', 'namespace' => 'QuestionCategory'], function () {
        Route::get('/', array('as' => 'admin.category', 'uses' => 'QuestionCategoryController@index'));
        Route::post('/', array('as' => 'admin.category.post', 'uses' => 'QuestionCategoryController@postData'));
        Route::get('/category-datatables', array('as' => 'admin.category.datatable', 'uses' => 'QuestionCategoryController@datatables'));
    });

    #-- Question
    Route::group(['prefix' => 'question', 'namespace' => 'Question'], function () {
        Route::get('/', array('as' => 'admin.question', 'uses' => 'QuestionController@index'));
        Route::post('/', array('as' => 'admin.question.post', 'uses' => 'QuestionController@postData'));
        Route::get('/category-datatables', array('as' => 'admin.question.datatable', 'uses' => 'QuestionController@datatables'));
    });
});