<?php

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('login/github', 'SocialLoginController@redirectToProvider')->name('github.login');
Route::get('login/github/callback', 'SocialLoginController@handleProviderCallback');

Route::group(['middleware' => ['auth', 'user']], function () {
    Route::get('/home', 'WebsiteController@list')->name('home');
    Route::post('/website', 'WebsiteController@save')->name('website.create');
    Route::get('/website/{id}', 'WebsiteController@show')->name('website.show');
    Route::put('/website/{id}', 'WebsiteController@update')->name('website.update');
    Route::delete('/website/{id}', 'WebsiteController@destroy')->name('website.delete');

    Route::get('/profile/{user_id}', 'UserController@show')->name('user.show');
    Route::put('/profile/{user_id}', 'UserController@update')->name('user.update');
});
Route::group(['middleware' => ['auth']], function () {
    Route::patch('/website/{id}', 'WebsiteController@status')->name('website.status');
    Route::post('/website-test/{id}', 'WebsiteController@test')->name('website.test');
});
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');
    Route::get('user/{user_id}/websites', 'WebsiteController@list')->name('user.websites');
});
Route::get('/scheduler/run', 'SchedulerController@run')->name('test.fail');
Route::get('/privacy-policy', function () {
    return view('public.privacy_policy');
})->name('privacy.policy');

Route::get('/faq', function () {
    return view('public.faq');
})->name('faq');
