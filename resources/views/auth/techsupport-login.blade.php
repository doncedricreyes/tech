@extends('layouts.app')
               

@section('content')

<style >
.form-group{
    position: relative;
}

i {
    position: absolute;
    top: 0;
    right: 0;
    padding: 10px;
}
.form-check-input {
    position: relative; 
    margin-top: 0; 
    margin-left: 0; 
}

.login-box {
    width: 400px;
    background: #e0e0df;
    box-shadow: 1px 1px 5px -3px #000000bf;
}

.login-logo{
    margin-bottom: 0; 
    padding: 20px;
}
</style>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<p class="login-box-msg">Sign in to start your session</p>
<form method="POST" action="{{ route('techsupport.login.submit') }}">
    @csrf
  <div class="form-group has-feedback">
    <input id="email" placeholder="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

    @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif
    <i class="fas fa-envelope form-control-feedback"></i>
  </div>
  <div class="form-group has-feedback">
    <input id="password" placeholder="Password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

    @if ($errors->has('password'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
    @endif
    <i class="fas fa-lock form-control-feedback"></i>
  </div>
  <div class="row">
    <div class="col-8">
      <div class="checkbox">
        <input class="form-check-input" style="width: 20px;" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

        <label class="form-check-label" for="remember">
            {{ __('Remember Me') }}
        </label>
      </div>
    </div>
    <!-- /.col -->
    <div class="col-4">
      <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
    </div>
    <!-- /.col -->
  </div>
</form>


<!-- /.social-auth-links -->
<div class="text-center">
<a style="color:#7fbf47;"  href="{{ route('techsupport.password.request') }}">I forgot my password</a><br>
</div>


@endsection