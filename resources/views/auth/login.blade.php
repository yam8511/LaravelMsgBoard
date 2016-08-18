@extends('layouts.app', ['login'=>false, 'title'=>'登入'])

@section('content')
<div class="w3-container">
    @if($errors->has('email'))
        <div class="w3-round w3-pale-yellow">
            <span onclick="this.parentElement.style.display='none'" class="w3-closebtn"><i class="fa fa-close"></i></span>
            <h3><i class="fa fa-child"></i>{{ $errors->first('email') }}</h3>
            <a class="w3-btn w3-btn-floating  w3-pink" title="加入我們" onclick="document.getElementById('modal_register').style.display='block'"><i class="fa fa-user-plus "></i></a>
        </div>
    @endif
    @if($errors->has('password'))
        <div class="w3-round w3-pale-red">
            <span onclick="this.parentElement.style.display='none'" class="w3-closebtn"><i class="fa fa-close"></i></span>
            <h3><i class="fa fa-frown-o"></i>{{ $errors->has('password') }}</h3>
        </div>
    @endif

    <div class="w3-card-4">
        <form class="w3-form w3-margin" role="form" method="POST" action="{{ url('/login') }}" accept-charset="UTF-8">
            {{ csrf_field() }}

            <div class="w3-input-group {{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="w3-label">E-Mail</label>
                <input id="email" type="email" class="w3-input w3-hover-border-cyan" name="email" value="{{ old('email') }}" required>
            </div>
            <div class="w3-input-group  {{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="w3-label">Password</label>
                <input id="password" type="password" class="w3-input w3-hover-border-cyan" name="password" required>
            </div>
            <div class="w3-input-group">
                <input name="remember" type="checkbox" class="w3-check">
                <label class="w3-label" for="form_remember">記住我</label>
            </div>
            <button type="submit" class="w3-btn w3-blue w3-ripple w3-round">Login</button>
        </form>
    </div>
</div>
@include('modal_register')
@endsection
