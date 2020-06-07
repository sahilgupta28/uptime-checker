<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'WebsiteController@index')->name('home');
    Route::post('/website', 'WebsiteController@save')->name('website.create');
    Route::post('/website-test/{id}', 'WebsiteController@test')->name('website.test');
});

// Route::get('{any}', 'AppController@index')->where('any', '.*');
