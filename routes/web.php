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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/blog', function () {
    return view('blog');
});
Route::get('/world', function () {
    return view('world');
});
Route::get('/community', function () {
    return view('community');
});
Route::get('/single', function () {
    return view('single');
});
Route::get('/contact', function () {
    return view('contact');
});

Route::resource('tag', 'Tag_Controller');
Route::resource('artikel', 'Artikel_Controller');
Route::resource('kategori', 'Kategori_Controller');
