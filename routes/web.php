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
    return redirect()->route('dashboard');
//    return view('welcome');
})->middleware('auth');

Route::resource('products', 'ProductController');

Auth::routes();

Route::get('/dashboard', function () {
    return view('welcome');
})->middleware('auth')->name('dashboard');

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('users', 'UserController');

Route::get('/getCurrentUser', function () {
    return Auth::user()->load('roles');
//    return \App\User::where('id', 2)->with('roles')->first();
});

Route::match(['get', 'post'], '/logout', 'Auth\LoginController@logout')->name('logout');
