<?php

namespace App\Http\Controllers;

use App\Reply;
use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

class ReplyController extends Controller
{
    public function addReply(Request $request) {
        if(!Auth::check()) {
            $request->session()->flash('failed', '請先登入，才能回覆!');
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
}
