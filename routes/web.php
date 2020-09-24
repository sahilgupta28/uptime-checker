<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'WebsiteController@index')->name('home');
    Route::post('/website', 'WebsiteController@save')->name('website.create');
    Route::get('/website/{id}', 'WebsiteController@show')->name('website.show');
    Route::put('/website/{id}', 'WebsiteController@update')->name('website.update');

    Route::post('/website-test/{id}', 'WebsiteController@test')->name('website.test');
    Route::get('/profile/{user_id}', 'UserController@show')->name('user.show');
    Route::put('/profile/{user_id}', 'UserController@update')->name('user.update');
});
Route::get('/scheduler/run', 'SchedulerController@run')->name('test.fail');
// Route::get('{any}', 'AppController@index')->where('any', '.*');
