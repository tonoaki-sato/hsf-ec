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

// ダッシュボード
Route::get('/home', 'HomeController@index')->name('home');

// プロフィール
Route::get('/profile', 'ProfileController@index')->name('profile');

// 利用登録
Route::get('/register/{passphrase}', 'Auth\RegisterController@showRegistrationForm');

Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');

// 議事録
Route::get('/minutes', 'MinutesController@index')->name('minutes');
Route::get('/minutes/add', 'MinutesController@add');
Route::get('/minutes/show/{{id}}', 'MinutesController@show');
Route::get('/minutes/edit/{{id}}', 'MinutesController@edit');

