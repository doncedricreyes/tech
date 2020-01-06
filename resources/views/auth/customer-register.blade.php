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
        width: 500px;
        background: #e0e0df;
        box-shadow: 1px 1px 5px -3px #000000bf;
    }
    
    .login-logo{
        margin-bottom: 0; 
        padding: 20px;
    }
    #register{
        position: relative;
        float: right;
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


<p class="login-box-msg">Create an account</p>
<form method="POST" action="{{ route('customer.register') }}">
    @csrf
    <div class="form-group has-feedback">
            <input id="name" type="text" placeholder="Name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
            <i class="fas fa-user form-control-feedback"></i>
          </div>
  <div class="form-group has-feedback">
    <input id="email" type="email" placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

    @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif
    <i class="fas fa-envelope form-control-feedback"></i>
  </div>
  <div class="form-group has-feedback">
        <input id="contact" type="number" placeholder="Contact" class="form-control{{ $errors->has('contact') ? ' is-invalid' : '' }}" name="contact" value="{{ old('contact') }}" required autofocus>

        @if ($errors->has('contact'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('contact') }}</strong>
            </span>
        @endif
        <i class="fas fa-phone form-control-feedback"></i>
      </div>
      <div class="form-group has-feedback">
            <input id="address" type="text" placeholder="Address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" required autofocus>
    
            @if ($errors->has('address'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('address') }}</strong>
                </span>
            @endif
            <i class="fas fa-address-card form-control-feedback"></i>
          </div>
  <div class="form-group has-feedback">
    <input id="password" type="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

    @if ($errors->has('password'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
    @endif
    <i class="fas fa-lock form-control-feedback"></i>
  </div>
  <div class="form-group has-feedback">
        <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" required>
        <i class="fas fa-lock form-control-feedback"></i>
      </div>

                            <div  id="register">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
<br><br>
</form>


<!-- /.social-auth-links -->

<div class="text-center">
    <a style="color:#7fbf47;"  href="{{ route('customer.login') }}">Already a member?</a><br>
  
  </div>
@endsection