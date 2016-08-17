<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $msgs = \App\Msgboard::orderBy('created_at','desc')->get();
        $len = $msgs->count();
        $item = 0;
        $style = [];
        for ($i=0; $i < $len; $i++) { 
            switch($i%3){
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
        
        
        $data = ['login'=>Auth::check(), 'title'=>'留言板', 'msgs'=>$msgs, 'auth'=>Auth::user(), 'style'=>$style];
        
        return view('welcome', $data);
    }

    /**
     * Add the message
     * 
     * @return \Response
     */
    public function add()
    {
        $data = ['login'=>Auth::check(), 'title'=>'有話要說..'];
        return view('add', $data);
    }

    
}
