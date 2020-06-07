<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/websites', 'WebsiteController@list')->name('home');
// });
