@extends('admin.auth.app')
@section('main-auth')
    <!-- BEGIN REGISTRATION FORM -->
    <form class="register" action="{{ route('postRegister') }}" method="post">
        {!! csrf_field() !!}
        <h3 class="font-green">Sign Up</h3>
        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <p> {{ $errors->first('name') }} </p>
                <p> {{ $errors->first('email') }} </p>
                <p> {{ $errors->first('password') }} </p>
                <p> {{ $errors->first('message') }} </p>
            </div>
        @endif
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Name</label>
            <input class="form-control placeholder-no-fix" type="text" placeholder="Name" name="name" />
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Email</label>
            <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" />
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="Password" name="password" />
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
            <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" id="password_confirmation" name="password_confirmation" />
        </div>
        <div class="form-actions">
            <a id="register-back-btn" class="btn green btn-outline" href="{{ route('login') }}">Back</a>
            <button type="submit" id="register-submit-btn" class="btn btn-success uppercase pull-right">Submit</button>
        </div>
    </form>
@endsection