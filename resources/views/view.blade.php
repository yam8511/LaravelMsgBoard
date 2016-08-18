@extends('layouts.app')

@section('content')
    <div class="w3-container w3-margin">
        <a class="w3-btn w3-btn-floating  w3-teal" title="留話" href="add"><i class="fa fa-plus"></i></a>
        @if($login)
            <a class="w3-btn w3-btn-floating  w3-blue" title="登出" href="logout"><i class="fa fa-sign-out"></i></a>
        @else
            <a class="w3-btn w3-btn-floating  w3-pink" title="加入我們" onclick="document.getElementById('modal_register').style.display='block'"><i class="fa fa-user-plus "></i></a>
            <a class="w3-btn w3-btn-floating  w3-blue" title="登入" onclick="document.getElementById('modal_login').style.display='block'"><i class="fa fa-sign-in"></i></a>
        @endif
    </div>

        @foreach($msgs as $index => $msg)
            <div class=" w3-container w3-margin-bottom  w3-leftbar  {{ $style[$index] }}">
                <div class="w3-container">
                    <!-- 留言標題 -->
                    <h2><b>{{ $msg->title }}</b></h2>
                    <!-- 留言人 -->
                    <a style="text-decoration: none;" class="w3-text-blue " {{ $msg->user_id != 0 ? "href=view/$msg->user_id" : '' }}><?= $msg->username($msg->user_id) ?></a>
                    <!-- 留言日期 -->
                    <br><span class="w3-text-grey w3-small">留言日期: {{ $msg->created_at }}</span>
                    <br><span class="w3-text-grey w3-small">更新日期: {{ $msg->updated_at }}</span>
                    <!-- 留言訊息 -->
                    <p><?= nl2br($msg->message) ?></p>
                    <!-- 修改&刪除按鈕 -->
                    @if($login && ( $msg->user_id == Auth::user()->id || Auth::user()->admin ) )
                        <a class="w3-btn-floating  w3-purple" title="修改" onclick="show('modal_edit_msg_{{ $msg->id }}')"><i
                                    class="fa fa-pencil"></i></a>
                        <a class="w3-btn-floating  w3-red" title="刪除" onclick="show('modal_delete_msg_{{ $msg->id }}')"><i class="fa
                fa-trash"></i></a>
                        @include('modal_edit', ['type' => 'msg', 'msg' => $msg])
                        @include('modal_delete', ['type' => 'msg', 'msg' => $msg ])
                    @endif
                </div>
                <!-- 回覆留言 -->
                <div class="w3-border-top w3-border-teal w3-padding">
                    @include('reply', ['login'=>$login, 'msg'=>$msg, 'bg' => $bg])
                </div>
            </div>
        @endforeach

        @include('modal_register')
        @include('modal_login')

@endsection
