<?php

Route::get('/', function ()
{
    return view('welcome');
});

Route::get('categories', ['as' => 'categories.index', 'uses' => 'CategoriesController@index']);
Route::get('categories/create', ['as' => 'categories.create', 'uses' => 'CategoriesController@create']);
Route::post('categories', ['as' => 'categories.store', 'uses' => 'CategoriesController@store']);
Route::get('categories/{id}/edit', ['as' => 'categories.edit', 'uses' => 'CategoriesController@edit']);
Route::put('categories/{id}', ['as' => 'categories.update', 'uses' => 'CategoriesController@update']);
Route::delete('categories/{id}', ['as' => 'categories.destroy', 'uses' => 'CategoriesController@destroy']);

Route::get('products', ['as' => 'products.index', 'uses' => 'ProductsController@index']);
Route::get('products/create', ['as' => 'products.create', 'uses' => 'ProductsController@create']);
Route::post('products', ['as' => 'products.store', 'uses' => 'ProductsController@store']);
Route::get('products/{id}/edit', ['as' => 'products.edit', 'uses' => 'ProductsController@edit']);
Route::put('products/{id}', ['as' => 'products.update', 'uses' => 'ProductsController@update']);
Route::delete('products/{id}', ['as' => 'products.destroy', 'uses' => 'ProductsController@destroy']);