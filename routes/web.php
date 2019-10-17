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

Auth::routes(['verify' => true]);

Route::get('auth/{provider}', 'CardController@redirectToProvider');
Route::get('auth/{provider}/callback', 'CardController@handleProviderCallback');
Route::get('twitter/callback', 'CardController@TwitterCallback');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/','PageController@index')->middleware('guest');
Route::get('/coperateactivate','PageController@coperateActivate');
Route::get('/wallet','PageController@contacts');

Route::get('/links','CardController@socialMedia');
Route::post('/savelinks','CardController@saveLinks');
Route::get('/design','CardController@design');
Route::post('savedesign','CardController@saveDesign');

Route::get('getConnectinfo','ConnectController@showConnect');

Route::get('getdetailid','CoperateController@getDetailId');
Route::post('savestaff','CoperateController@saveStaff');
Route::get('coperateuser/create','CoperateController@createCoperateUser');
Route::post('updatecoperateuser','CoperateController@updateCoperateUser');


Route::resource('card','CardController');
Route::resource('connect','ConnectController');
Route::resource('coperate','CoperateController');
Route::resource('review', 'ReviewController');

Route::group(['middleware' => ['auth']], function(){
    Route::get('/user', 'GraphController@retrieveUserProfile');
});

