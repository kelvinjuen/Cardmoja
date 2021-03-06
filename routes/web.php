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

Route::get('/', 'HomeController@index')->name('home');
//Route::get('/','PageController@index')->middleware('guest');
Route::get('/coperateactivate','PageController@coperateActivate');
Route::get('/wallet','PageController@contacts');
Route::get('/setting','PageController@setting');
Route::get('/contactus','PageController@contactus');

Route::get('/links','CardController@socialMedia');
Route::post('/savelinks','CardController@saveLinks');
Route::get('/design','CardController@design');
Route::post('savedesign','CardController@saveDesign');

Route::get('getConnectinfo','ConnectController@showConnect');
Route::get('getcontacts','ConnectController@showContacts');

Route::get('getdetailid','CoperateController@getDetailId');
Route::post('savestaff','CoperateController@saveStaff');
Route::get('coperateuser/create','CoperateController@createCoperateUser');
Route::post('updatecoperateuser','CoperateController@updateCoperateUser');

Route::post('savesetting','SettingController@SaveSetting');
Route::get('getsetting/{id}','SettingController@getSetting');

Route::get('getusersInfo', 'AdminController@showInfo');

Route::resource('card','CardController');
Route::resource('connect','ConnectController');
Route::resource('coperate','CoperateController');
Route::resource('review', 'ReviewController');
Route::resource('admin', 'AdminController');

Route::group(['middleware' => ['auth']], function(){
    Route::get('/user', 'GraphController@retrieveUserProfile');
});
Route::get('storage/{filename}', function ($filename)
{
    $path = storage_path('public/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});

