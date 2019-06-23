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


Route::get('/fashion', function () {
    return view('fashion');
});

Route::get('/archives', function () {
    return view('archives');
});

Route::get('/single', function () {
    return view('single');
});

Route::get('/sports', function () {
    return view('sports');
});

Route::get('/style', function () {
    return view('style');
});

Route::get('/travel', function () {
    return view('travel');
});

Route::get('/video', function () {
    return view('video');
});
