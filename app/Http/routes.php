<?php

Route::get('/', function ()
{
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function ()
{
    Route::pattern('id', '[0-9]+');

    Route::get('categories', ['as' => 'admin.categories.index', 'uses' => 'AdminCategoriesController@index']);
    Route::get('categories/create', ['as' => 'admin.categories.create', 'uses' => 'AdminCategoriesController@create']);
    Route::post('categories', ['as' => 'admin.categories.store', 'uses' => 'AdminCategoriesController@store']);
    Route::get('categories/{id}', ['as' => 'admin.categories.show', 'uses' => 'AdminCategoriesController@show']);
    Route::get('categories/{id}/edit', ['as' => 'admin.categories.edit', 'uses' => 'AdminCategoriesController@edit']);
    Route::put('categories/{id}', ['as' => 'admin.categories.update', 'uses' => 'AdminCategoriesController@update']);
    Route::delete('categories/{id}', ['as' => 'admin.categories.destroy', 'uses' => 'AdminCategoriesController@destroy']);
    //Route::resource('categories', 'AdminCategoriesController');

    Route::get('products', ['as' => 'admin.products.index', 'uses' => 'AdminProductsController@index']);
    Route::get('products/create', ['as' => 'admin.products.create', 'uses' => 'AdminProductsController@create']);
    Route::post('products', ['as' => 'admin.products.store', 'uses' => 'AdminProductsController@store']);
    Route::get('products/{id}', ['as' => 'admin.products.show', 'uses' => 'AdminProductsController@show']);
    Route::get('products/{id}/edit', ['as' => 'admin.products.edit', 'uses' => 'AdminProductsController@edit']);
    Route::put('products/{id}', ['as' => 'admin.products.update', 'uses' => 'AdminProductsController@update']);
    Route::delete('products/{id}', ['as' => 'admin.products.destroy', 'uses' => 'AdminProductsController@destroy']);
    //Route::resource('products', 'AdminProductsController');
});