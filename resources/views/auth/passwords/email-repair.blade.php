@extends('layouts.app')
       

@section('content')
  

<p class="login-box-msg">Repairman Reset Password</p>
<form method="POST" action="{{ route('repair.password.email') }}">
    @csrf
  <div class="form-group has-feedback">
    <input id="email" placeholder="Email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

    @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif
    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
  </div>
  <div class="col-xs-4"  name ="submit">
    <button type="submit" class="btn btn-primary btn-block btn-flat">Send</button>
  </div>
  <div class="row">

    <!-- /.col -->
  
    <!-- /.col -->
  </div>
</form>


@endsection