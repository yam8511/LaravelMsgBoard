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
use Illuminate\Support\Facades\Auth;
Route::get('/', function () {
    $user = \App\User::find(1);
    $data = ['user'=>$user,'login'=>true];
    return view('welcome', $data);
});

Route::auth();

Route::get('/home', 'HomeController@index');

/*
Route::get('/', 'HomeController@index');

Route::post('/', 'HomeController@process');

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/add','HomeController@add')->middleware('auth');
*/