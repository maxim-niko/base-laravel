<?php

Route::get('articles', 'ArticleController@index')->name('article.index');
Route::post('articles', 'ArticleController@store')->name('article.store');

Route::get('articles/{id}', 'ArticleController@show')->name('article.show')->where(['id' => '\d+']);