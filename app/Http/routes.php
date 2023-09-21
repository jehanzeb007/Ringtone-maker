<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

////////////dashbbard routing start here////////////////////////////////////////////////////////////////////////////////////////
Route::group(['module' => 'Web', 'prefix' => '/'], function() {
	Route::get('/','DashboardController@index');
	Route::post('upload','DashboardController@upload');
	Route::get('drawUpload/{id}','DashboardController@drawUpload');
	Route::any('cut/{id}','DashboardController@cut');
	Route::any('result/{id}','DashboardController@cutResult');
	Route::any('download/{id}','DashboardController@download');
	Route::get('sample','DashboardController@sample');	
	Route::get('set_lang/{lang}','DashboardController@setLang');
	
	Route::get('admin','DashboardController@admin');
	Route::post('login','DashboardController@login');
	Route::post('update_seo','DashboardController@update_seo');
	
	Route::any('clean-convert-files','DashboardController@cleanConvertFiles');
	
	Route::group(['middleware' => ['auth']], function () {
	
	});
});