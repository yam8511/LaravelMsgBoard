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

Route::auth();

Route::get('/', 'MsgboardController@index');

Route::get('home', 'MsgboardController@index');

Route::get('add','MsgboardController@add');

Route::post('/', 'MsgboardController@addProcess');

Route::put('edit_msg','MsgboardController@editMessage');

Route::delete('del_msg', 'MsgboardController@deleteMessage');

Route::put('edit_rpl','MsgboardController@editReply');

Route::delete('del_rpl', 'MsgboardController@deleteReply');

Route::post('reply', 'ReplyController@addReply');

Route::get('test', function(){
    $msgs = Msgboard::all();
    foreach($msgs as $msg){
        echo $msg->title . ". Posted by " . $msg->userInfo($msg->user_id)->name . "<br>";
    }
});
