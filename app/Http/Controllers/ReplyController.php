<?php

namespace App\Http\Controllers;

use App\Reply;
use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

class ReplyController extends Controller
{
    public function __construct() {
        if(!Auth::check()) {
            return redirect('login');
        }
    }
    /**
     * add the Reply to DB
     */
    public function addReply(Request $request) {
        if(!Auth::check()) {
            return redirect('login');
        }

        if ($request->input('message') == '') {
            return redirect('/');
        }

        $rpl = new Reply();
        $rpl->message = $request->input('message');
        $rpl->msgboard_id = $request->input('msg_id');
        $rpl->user_id = Auth::user()->id;
        if(!$rpl->save()) {
            $request->session()->flash('failed', '回覆發生錯誤');
            return redirect('/');
        }
        $request->session()->flash('success', '回覆成功');
        return redirect('/');
    }


    public function editReply(Request $request) {
        if(!Auth::check()) {
            return redirect('login');
        }

        if ($request->input('message') == '') {
            return redirect('/');
        }

        
        $msg = Reply::find($request->input('id'));

        if($msg) {
            if(Auth::user()->id != $msg->user_id) {
                $request->session()->flash('failed', '這不是你的回覆!');
                return redirect('/');
            }

            $origin_msg = preg_replace('/\s(?=)/', '', trim($msg->message));
            $new_msg = preg_replace('/\s(?=)/', '', trim($request->input('message')));

            if($origin_msg == $new_msg) {
                return redirect('/');
            }

            $msg->message = $request->input('message');
            $msg->save();
            $request->session()->flash('success', 'Reply 編輯成功');
        } else {
            $request->session()->flash('failed', 'Reply 編輯錯誤');
        }
        return redirect('/');
    }

    public function deleteReply(Request $request)
    {
        $rpl = Reply::find($request->input('id'));
        if($rpl) {
            $rpl->delete();
            $request->session()->flash('success', 'Reply 刪除成功');
        } else {
            $request->session()->flash('failed', 'Reply 刪除失敗');
        }
        return redirect('/');
    }

}
