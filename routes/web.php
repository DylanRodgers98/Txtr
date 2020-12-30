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
    // this will need reinstating with controller method & view instead of redirect when admin user role created
    Route::get('posts', fn() => redirect()->route('home'))->name('posts.index');

    Route::post('posts', 'PostController@store')->name('posts.store');

    Route::get('posts/{post}', 'PostController@show')->name('posts.show');

    Route::delete('posts/{post}', 'PostController@destroy')->name('posts.destroy');

    /**
     * User routes
     */
    Route::get('users', 'UserController@index')->name('users.index');

    Route::get('users/create', 'UserController@create')->name('users.create');

    Route::post('users', 'UserController@store')->name('users.store');

    Route::get('users/{user}', 'UserController@show')->name('users.show');

    Route::get('users/{user}/following', 'UserController@indexFollowing')->name('users.indexFollowing');

    Route::get('users/{user}/followers', 'UserController@indexFollowers')->name('users.indexFollowers');

    Route::delete('users/{user}', 'UserController@destroy')->name('users.destroy');
});
