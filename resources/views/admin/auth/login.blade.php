@extends('admin.auth.app')
@section('main-auth')
    <form class="login-form" action="{{ route('postLogin') }}" method="post">
        {!! csrf_field() !!}
        <h3 class="form-title font-green">Sign In</h3>
        @if(count($errors) > 0)
        <div class="alert alert-danger">
            <p> {{ $errors->first('email') }} </p>
            <p> {{ $errors->first('message') }} </p>
            <p> {{ $errors->first('password') }} </p>
        </div>
        @endif
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has($msg))
                <div class="alert alert-{{ $msg }}">
                    <p>{{ Session::get($msg) }}</p>
                </div>
            @endif
        @endforeach
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Email</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" />
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" />
        </div>
        <div class="form-actions">
            <label class="rememberme check mt-checkbox mt-checkbox-outline" style="margin-top: 10px">
                <input type="checkbox" name="remember" value="1" />Remember
                <span></span>
            </label>
            <button type="submit" class="btn green uppercase" style="float: right;">Login</button>
        </div>
        <div class="create-account">
            <p>
                <a href="{{ route('register') }}" id="register-btn" class="uppercase">Create an account</a>
            </p>
        </div>
    </form>
@endsection