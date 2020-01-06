
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PIOLINX ENGINEERING SERVICES</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Theme style -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
  <script src="{{ asset('js/app.js') }}"></script>


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <img src="/storage/images/vasus2.jpg" id="logo" width="200"></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
   @yield('content')
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<script>
</script>
</body>
</html>
