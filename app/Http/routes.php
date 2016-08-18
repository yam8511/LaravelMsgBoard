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

Route::put('edit_msg','MsgboardController@editMessage')->middleware('auth');

Route::delete('del_msg', 'MsgboardController@deleteMessage')->middleware('auth');

Route::put('edit_rpl','ReplyController@editReply')->middleware('auth');

Route::delete('del_rpl', 'ReplyController@deleteReply')->middleware('auth');

Route::post('reply', 'ReplyController@addReply');

Route::get('belong', 'MsgboardController@belongUser')->middleware('auth');

Route::get('view/{id}', 'MsgboardController@viewUser');

Route::get('/test', function(){
    $msg = App\Msgboard::find(37);
    echo $msg->title;
    echo $msg->uploads[0]->name;
});
/*
@if($msg->uploads)
            <div class="w3-container">
                <img class="w3-round" src="{{ $msg->uploads[0]->saved_to.'/'.$msg->uploads[0]->saved_as }}" alt="{{ $msg->uploads[0]->name }}">
            </div>
@endif
*/