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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'pageControllers@index');
Route::get('/about', 'pageControllers@about');
Route::get('/services', 'pageControllers@services');

// Route::resource('posts','postsController');

Route::get('posts','postsController@index');
Route::post('posts','postsController@store');
Route::get('posts/create','postsController@create');
Route::get('posts/{post}','postsController@show');
// Route::put('posts/{post}','postsController@update');
Route::match(['put', 'patch'],'posts/{post}', 'postsController@update');
Route::delete('posts/{post}','postsController@destroy');
Route::get('posts/{post}/edit','postsController@edit');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
