@extends('layouts.app')

@section('content')
<h1>留下訊息</h1>
<a class="w3-btn w3-btn-floating  w3-green" href="/"><i class="fa fa-mail-reply"></i></a>
<form action="/" method="post" accept-charset="utf-8" class="w3-form w3-border w3-border-teal w3-margin">
    <label class="w3-label">標題</label>
    <input type="text" name="title" class="w3-input w3-hover-border-cyan" placeholder="輸入主題" required>
    <br>
    <label class="w3-label">暱稱</label>
    <input type="text" name="name" class="w3-input w3-hover-border-cyan" readonly>
    <br>
    <label class="w3-label">訊息</label>
    <textarea class="auto-height w3-input w3-border w3-hover-border-cyan" style="resize:none;" placeholder="輸入內容" required></textarea>
    <br>
    <input type="hidden" name="user_id">
    <input type="submit" name="send" value="留言" class="w3-btn w3-teal w3-ripple">
</form>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript"> 
    $(document).ready(function(){
    $("textarea.auto-height").css("overflow", "hidden").bind("keydown keyup", function(){
                $(this).height('0px').height($(this).prop("scrollHeight") + 'px');
            }).keydown();
        });
</script> 
@endsection