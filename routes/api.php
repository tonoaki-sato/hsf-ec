<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/orgcharts/get', 'OrgchartController@get')->name('orgcharts.get');
Route::post('/orgcharts/save_node', 'OrgchartController@save_node')->name('orgcharts.save_node');
Route::post('/orgcharts/add_edge', 'OrgchartController@add_edge')->name('orgcharts.add_edge');
Route::post('/orgcharts/delete_node', 'OrgchartController@delete_node')->name('orgcharts.delete_node');
Route::post('/orgcharts/delete_edge', 'OrgchartController@delete_edge')->name('orgcharts.delete_edge');
Route::get('/orgcharts/show_node/{id}', 'OrgchartController@show_node')->name('orgcharts.show_node');
Route::post('/orgcharts/add_member', 'OrgchartController@add_member')->name('orgcharts.add_member');
Route::post('/orgcharts/delete_member', 'OrgchartController@delete_member')->name('orgcharts.delete_member');
// schedules
Route::get('/schedules/show', 'ApiScheduleController@show')->name('api_schedule.show');
//
Route::get('/schedule_groups/show', 'ApiScheduleGroupController@show')->name('api_schedule_groups.show');
//
Route::get('/schedule_items/show', 'ApiScheduleItemController@show')->name('api_schedule_items.show');
