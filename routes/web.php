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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('profile/{slug}', [
        'uses' => 'ProfilesController@index',
        'as' => 'profile'
    ]);

    Route::get('profile/edit/{slug}', [
        'uses' => 'ProfilesController@edit',
        'as' => 'profile.edit'
    ]);

    Route::post('profile/update/{slug}', [
        'uses' => 'ProfilesController@update',
        'as' => 'profile.update'
    ]);

    Route::get('check/relationship/status/{id}', [
        'uses' => 'FriendshipsController@check',
        'as' => 'check'
    ]);

    Route::get('add/friend/{id}', [
        'uses' => 'FriendshipsController@addFriend',
        'as' => 'add.friend'
    ]);

    Route::get('accept/friend/{id}', [
        'uses' => 'FriendshipsController@acceptFriend',
        'as' => 'accept.friend'
    ]);

    Route::get('notifications', [
        'uses' => 'HomeController@notifications',
        'as' => 'nots'
    ]);

    Route::get('get/unread', function () {
        return Auth::user()->unreadNotifications;
    });

    Route::post('create/post', [
        'uses' => 'PostController@store',
        'as' => 'post.create'
    ]);

    Route::get('feed', [
        'uses' => 'FeedsController@feed',
        'as' => 'feeda'
    ]);

    Route::get('get/auth/user', function () {
        return Auth::user();
    });

    Route::post('like', [
        'uses' => 'LikesController@like',
        'as' => 'like'
    ]);

    Route::post('unlike', [
        'uses' => 'LikesController@unlike',
        'as' => 'unlike'
    ]);
});
