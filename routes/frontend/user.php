<?php

Route::post('subscribe', 'UserController@subscribe')->name('subscribe');
Route::post('unsubscribe', 'UserController@unsubscribe')->name('unsubscribe');
