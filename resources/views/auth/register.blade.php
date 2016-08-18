@extends('layouts.app', ['login'=>false, 'title'=>'註冊'])

@section('content')
<div class="w3-container">
    <div class="w3-card-4">
        <form name="registerForm" action="register" method="post" onsubmit="return validate()" accept-charset="utf-8" class="w3-form  w3-margin ">
            {{ csrf_field() }}
            <div class="w3-input-group">
                <label class="w3-label" for="form_username">名稱</label>
                <input name="name" class="w3-input w3-hover-border-cyan" placeholder="您的名稱" required="required" value="{{ old('name') }}" id="form_username" type="text">
                @if (old('register') && $errors->has('name'))
                    <p class="help-block hint"><strong>{{ $errors->first('name') }}</strong></p>
                @endif
            </div>
            <div class="w3-input-group">
                <label class="w3-label" for="form_password">密碼</label>
                <input class="w3-input w3-hover-border-cyan" placeholder="您的密碼" required="required" name="password" value="" id="form_password" type="password">
                @if (old('register') && $errors->has('password'))
                    <p class="help-block hint"><strong>{{ $errors->first('password') }}</strong></p>
                @endif
            </div>

            <div class="w3-input-group">
                <label class="w3-label" for="form_comfirm">確認密碼</label>
                <input class="w3-input w3-hover-border-cyan" placeholder="確認密碼" required="required" name="password_confirmation" value="" id="form_confirm" type="password">
                @if (old('register') && $errors->has('password_confirmation'))
                    <p class="help-block hint"><strong>{{ $errors->first('password_confirmation') }}</strong></p>
                @endif
            </div>

            <div class="w3-input-group">
                <label class="w3-label" for="form_email">E-mail</label>
                <input class="w3-input w3-hover-border-cyan" placeholder="您的E-mail" required="required" name="email" value="{{ old('email') }}" id="form_email" type="email">
                @if (old('register') && $errors->has('email'))
                    <p class="help-block hint"><strong>{{ $errors->first('email') }}</strong></p>
                @endif
            </div>

            <input class="w3-btn w3-pink w3-ripple" name="register" value="註冊" id="form_send"
                   type="submit">
        </form>
    </div>
</div>
@endsection
