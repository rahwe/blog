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

Route::get('/contact', 'HomeController@contact')->name('contact');
Route::get('secret','HomeController@secret')
->name('secret')
->middleware('can:contact.secret');

//use all route
//Route::resource('/posts','PostController')->only(['index','show','create','store']);
Route::resource('/posts','PostController');

Auth::routes();
