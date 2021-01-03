<?php

use Illuminate\Support\Facades\Route;

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
require __DIR__.'/auth.php';

// apply auth middleware to all non-auth routes
Route::middleware('auth')->group(function () {
    /**
     * Home route
     */
    Route::get('/', 'PostController@index')->name('home');

    /**
     * Post routes
     */
    Route::post('posts', 'PostController@store')->name('posts.store');

    Route::get('posts/{post}', 'PostController@show')->name('posts.show');

    Route::get('posts/{post}/edit', 'PostController@edit')->name('posts.edit');

    Route::put('posts/{post}', 'PostController@update')->name('posts.update');

    Route::delete('posts/{post}', 'PostController@destroy')->name('posts.destroy');

    /**
     * User routes
     */
    Route::get('users', 'UserController@index')->name('users.index');

    Route::get('users/{user}', 'UserController@show')->name('users.show');

    Route::get('users/{user}/following', 'UserController@indexFollowing')->name('users.indexFollowing');

    Route::get('users/{user}/followers', 'UserController@indexFollowers')->name('users.indexFollowers');

    Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit');

    Route::put('users/{user}', 'UserController@update')->name('users.update');

    Route::delete('users/{user}', 'UserController@destroy')->name('users.destroy');

    /**
     * User Profile routes
     */
    Route::get('users/{user}/profile/edit', 'ProfileController@edit')->name('users.profile.edit');

    Route::put('users/{user}/profile', 'ProfileController@update')->name('users.profile.update');

    /**
     * Notifications routes
     */
    Route::get('notifications', 'NotificationController@index')->name('notifications.index');
});
