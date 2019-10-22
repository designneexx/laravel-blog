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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/posts', 'PostController@index');

Route::get('/posts/{post}', 'PostController@show');

Route::get('/posts-create', 'PostController@create')->middleware("auth");


//Route::group(['middleware' => 'auth:api'], function () {
//
//    Route::auth();
//    Route::get('/posts-create', 'PostController@create');
//    // Moving here will ensure that sessions, csrf, etc. is included in all these routes
//});
