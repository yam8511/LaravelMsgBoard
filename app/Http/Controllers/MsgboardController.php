<?php

namespace App\Http\Controllers;

use App\Msgboard;
use App\Upload;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Illuminate\Support\Facades\File;

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
    public function add(Request $request)
    {
        $data = ['login' => Auth::check(), 'title' => '留下訊息..', 'failed' => false];
        if($request->session()->has('failed')) {
            $data['failed'] = $request->session()->get('failed');
        }
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
        echo dirname($_SERVER['HTTP_HOST']);
        $destinationPath = dirname($_SERVER['HTTP_HOST']).'/uploads';
        $msg = new Msgboard();
        $msg->title = $request->input('title');
        $msg->message = $request->input('message');

        $file = null;
        if($request->hasFile('photo')) {
            $file = $request->file('photo');
            if($file->getExtension() != null || $file->extension() == 'img' || $file->extension() == 'png' || $file->extension() == 'jpg' || $file->extension() == 'jpeg' || $file->extension() == 'gif') {
                if(!$file->isValid()) {
                    $request->session()->flash('failed','檔案無效: '.$file->extension());
                    return redirect('add');
                }
            } else {
                $request->session()->flash('failed','檔案錯誤: '.$file->extension());
                return redirect('add');
            }
        }

        if(Auth::check()) {
            $msg->user_id = Auth::user()->id;
        }
        $msg->save();

        if($file) {
            $filename = 'photo_'.$msg->id.'.'.$file->extension();
            $upload = new Upload();
            $upload->name = $file->getClientOriginalName();
            $upload->extension = $file->extension();
            $upload->saved_as = $filename;
            $upload->saved_to = $destinationPath;
            $upload->msgboard_id = $msg->id;
            $upload->save();
            $file->move($destinationPath,$filename);
        }

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

    /**
     * view the myself msgboard
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function belongUser(Request $request)
    {
        $msgs = Msgboard::where('user_id', Auth::user()->id)->orderBy('updated_at', 'desc')->get();
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

        $data = ['login' => Auth::check(), 'title' => '我的留言', 'msgs' => $msgs, 'style' => $style, 'bg' => $bg,'success' => false, 'failed' => false ];

        if($request->session()->has('success')) {
            $data['success'] = $request->session()->get('success');
        }

        if($request->session()->has('failed')) {
            $data['failed'] = $request->session()->get('failed');
        }

        return view('msgboard', $data);
    }

    /**
     * view other people msgboard
     *
     * @param $id
     * @return View
     */
    public function viewUser($id)
    {
        if(Auth::check() && $id == Auth::user()->id) {
            return redirect('belong');
        }

        $user = User::find($id);
        if(!$user) {
            return redirect('/');
        }

        $msgs = Msgboard::where('user_id', $id)->orderBy('updated_at', 'desc')->get();
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

        $data = ['login' => Auth::check(), 'title' => $user->name.'的留言', 'msgs' => $msgs, 'style' => $style, 'bg' => $bg];

        return view('view', $data);
    }
}
