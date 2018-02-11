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
// ユーザー
Route::get('/users', 'UserController@index')->name('user');

// 利用登録
Route::get('/register/{passphrase}', 'Auth\RegisterController@showRegistrationForm');

Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');

// 議事録
Route::get('/minutes', 'MinutesController@index')->name('minutes');
Route::get('/minutes/create', 'MinutesController@create')->name('minutes.create');
Route::post('/minutes/store', 'MinutesController@store')->name('minutes.store');
Route::get('/minutes/show/{id}', 'MinutesController@show')->name('minutes.show');
Route::get('/minutes/edit/{id}', 'MinutesController@edit')->name('minutes.edit');
Route::post('/minutes/update', 'MinutesController@update')->name('minutes.update');

// メーリングリスト
Route::get('/ml_mails', 'MlMailsController@index')->name('ml_mails');
Route::get('/ml_mails/show/{id}', 'MlMailsController@show')->name('ml_mails.show');
Route::get('/ml_mails/download/{id}', 'MlMailsController@download')->name('ml_mails.download');
Route::get('/ml_mails/create', 'MlMailsController@create')->name('ml_mails.create');
Route::post('/ml_mails/send', 'MlMailsController@send')->name('ml_mails.send');

// 組織図
Route::get('/orgcharts', 'OrgchartController@index')->name('orgcharts');
Route::get('/organizations/{year?}', 'OrganizationController@index')->name('organization');
Route::get('/organizations/edit/{id}', 'OrganizationController@edit')->name('organization.edit');
Route::post('/organizations/update', 'OrganizationController@update')->name('organization.update');
Route::post('/organizations/store', 'OrganizationController@store')->name('organization.store');
Route::get('/organizations/delete/{id}', 'OrganizationController@destroy')->name('organization.destroy');

// スケジュール
Route::get('/schedules', 'ScheduleController@index')->name('schedules');
