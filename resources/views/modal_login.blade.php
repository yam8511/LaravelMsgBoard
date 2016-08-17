<?php
/**
 * Created by PhpStorm.
 * User: yam8511_li
 * Date: 2016/8/17
 * Time: 上午 10:31
 */
?>

<div id="modal_login" class="w3-modal" style="z-index: 900;
@if (!old('register') && ($errors->has('email') || $errors->has('password') ) )
        display: block;
@endif
">
    <div class="w3-modal-content w3-animate-zoom w3-card-8">
        <header class="w3-container w3-blue">
            <span onclick="document.getElementById('modal_login').style.display='none'" class="w3-closebtn"><i class="fa fa-close"></i></span>
            <h2><i class="fa fa-user"></i>登入</h2>
        </header>
        <div class="w3-container">
            <form name="loginForm" action="login" method="post" accept-charset="utf-8" class="w3-form  w3-margin ">
                {{ csrf_field() }}

                <label class="w3-label" for="form_email">E-mail</label>
                <input class="w3-input w3-hover-border-cyan" placeholder="您的E-mail" required="required" name="email" value="{{ old('email') }}" id="form_email" type="email">

                <label class="w3-label" for="form_password">密碼</label>
                <input class="w3-input w3-hover-border-cyan" placeholder="您的密碼" required="required" name="password" value="" id="form_password" type="password">
                @if (!old('register') && $errors->has('email'))
                    <p class="help-block hint"><strong>{{ $errors->first('email') }}</strong></p>
                @endif
                @if (!old('register') && $errors->has('password'))
                    <p class="help-block hint"><strong>{{ $errors->first('password') }}</strong></p>
                @endif

                <input class="w3-btn w3-blue w3-ripple" name="login" value="登入" id="form_send" type="submit">

                <input name="remember" type="checkbox" class="w3-check">
                <label class="w3-label" for="form_remember">記住我</label>
            </form>
        </div>
    </div>
</div>
