<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['prefix' => '/'], function () {
    // Redirect to create
    Route::get('', 'InstagramMediaList@index')->name('instagram.media.index');
    Route::get('user-media', 'InstagramMediaList@resolve')->name('instagram.media.resolve');
    Route::get('user-media-list/{access_token}', 'InstagramMediaList@gallery')->name('instagram.media.list');
});
