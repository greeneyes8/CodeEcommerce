<?php

Route::get('/', function ()
{
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'where' => ['id' => '[0-9]+']], function ()
{

    Route::group(['prefix' => 'categories'], function ()
    {
        Route::get('/', ['as' => 'categories.index', 'uses' => 'CategoriesController@index']);
        Route::get('create', ['as' => 'categories.create', 'uses' => 'CategoriesController@create']);
        Route::post('/', ['as' => 'categories.store', 'uses' => 'CategoriesController@store']);
        Route::get('{id}/edit', ['as' => 'categories.edit', 'uses' => 'CategoriesController@edit']);
        Route::put('{id}', ['as' => 'categories.update', 'uses' => 'CategoriesController@update']);
        Route::delete('{id}', ['as' => 'categories.destroy', 'uses' => 'CategoriesController@destroy']);
    });

    Route::group(['prefix' => 'products'], function ()
    {
        Route::get('/', ['as' => 'products.index', 'uses' => 'ProductsController@index']);
        Route::get('create', ['as' => 'products.create', 'uses' => 'ProductsController@create']);
        Route::post('/', ['as' => 'products.store', 'uses' => 'ProductsController@store']);
        Route::get('{id}/edit', ['as' => 'products.edit', 'uses' => 'ProductsController@edit']);
        Route::put('{id}', ['as' => 'products.update', 'uses' => 'ProductsController@update']);
        Route::delete('{id}', ['as' => 'products.destroy', 'uses' => 'ProductsController@destroy']);
    });
});