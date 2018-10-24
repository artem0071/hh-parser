<?php

Route::get('/', 'ItemController@index')->name('main');
Route::get('/items/{item}', 'ItemController@show')->name('item');
Route::get('/imports', 'ItemController@updateCatalog')->name('load');
