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

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

// Admin
Route::group(['namespace' => 'Admin','prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'DashboardController@index');
    Route::get('dashboard', [
        'as' => 'admin.dashboard',
        'uses' => 'DashboardController@index'
    ]);

    Route::resource("users", "UserController");
    Route::get('users/delete/{id}', [
        'as' => 'admin.users.delete',
        'uses' => 'UserController@destroy',
    ]);
});