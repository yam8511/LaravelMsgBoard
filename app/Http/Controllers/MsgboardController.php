<?php

namespace App\Http\Controllers;

use App\Msgboard;
use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

class MsgboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        #$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $msgs = Msgboard::all()->sortByDesc('updated_at');
        $style = [];
        $bg = ['w3-black', 'w3-white'];

        for($i = 0; $i < $msgs->count(); $i++) {
            switch ($i % 3) {
                case 0:
                    $style[$i] = 'w3-pale-blue w3-border-blue';
                    break;
                case 1:
                    $style[$i] = 'w3-pale-green w3-border-teal';
                    break;
                default:
                    $style[$i] = 'w3-pale-yellow w3-border-yellow';
                    break;
            }
        }

        $data = ['login' => Auth::check(), 'title' => '留言板', 'msgs' => $msgs, 'style' => $style, 'bg' => $bg,'success' => false, 'failed' => false];

        if($request->session()->has('success')) {
            $data['success'] = $request->session()->get('success');
        }

        if($request->session()->has('failed')) {
            $data['failed'] = $request->session()->get('failed');
        }

        return view('msgboard', $data);
    }

    /**
     * Add the message
     *
     * @return \Response
     */
    public function add()
    {
        $data = ['login'=>Auth::check(), 'title'=>'留下訊息..'];
        return view('add', $data);
    }

    /**
     * deal with the add request
     *
     * @param Request $request
     * @return \Redirector
     */
    public function addProcess(Request $request)
    {
        $msg = new Msgboard();
        $msg->title = $request->input('title');
        $msg->message = $request->input('message');
        if(Auth::check())
        {
            $msg->user_id = Auth::user()->id;
        }
        $msg->save();
        $request->session()->flash('success','留言成功');
        return redirect('/');
    }

    /**
     * edit the message
     *
     * @param Request $request
     * @return \Redirector
     */
    public function editMessage(Request $request)
    {
        if(!Auth::user()->id != $request->input('id')) {
            $request->session()->flash('failed', '這不是你發的文!');
            return redirect('/');
        }
        
        $msg = Msgboard::find($request->input('id'));
        if($msg) {
            $origin_msg = preg_replace('/\s(?=)/', '', trim($msg->message));
            $new_msg = preg_replace('/\s(?=)/', '', trim($request->input('message')));

            if($origin_msg == $new_msg) {
                return redirect('/');
            }

            $msg->message = $request->input('message');
            $msg->save();
            $request->session()->flash('success', '編輯成功');
        } else {
            $request->session()->flash('failed', '編輯錯誤');
        }
        return redirect('/');
    }

    /**
     * delete the message
     *
     * @param Request $request
     * @return \Redirector
     */
    public function deleteMessage(Request $request)
    {
        $msg = Msgboard::find($request->input('id'));
        if($msg) {
            $msg->delete();
            $request->session()->flash('success', '刪除成功');
        } else {
            $request->session()->flash('failed', '刪除失敗');
        }
        return redirect('/');
    }


}
