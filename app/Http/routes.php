<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/categories', 'AdminCategoriesController@index');
Route::get('admin/products', 'AdminProductsController@index');
