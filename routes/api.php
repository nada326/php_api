<?php

Route::apiResource('products', 'ProductController');
Route::apiResource('categories', 'CategoryController');

Route::get('product-by-vuforiaId/{id}', 'ProductController@getProductByVurfiayId');


