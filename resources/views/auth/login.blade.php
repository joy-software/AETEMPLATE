<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Karmanta - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="LACY 2017">
    <meta name="keyword" content="Promo-vogt, alumni, anciens, vogtois, anciens vogtois">
    <link rel="shortcut icon" href={!! url('cache/original/'."img/favicon.png") !!}>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        // rename myToken as you like
        window.Laravel ={!! json_encode([
              'csrfToken' => csrf_token(),
        ]) !!};
        var userId = {!! json_encode( Auth::id()) !!};

    </script>

    <title>Connexion | PromotVogt</title>


    <!-- Custom styles -->
    <link href="{{ asset('assets/css/site2.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/login.css') }}" rel="stylesheet" />
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
    <script src="{{ asset('js/kar.js') }}"></script>
    <![endif]-->
</head>

<body class="login-img3-body">

<div class="container">


    @if(\Illuminate\Support\Facades\Session::has('message'))
        <div class="alert alert-block ">
            {!! \Illuminate\Support\Facades\Session::get('message')  !!}
        </div>
    @endif

    @if (isset($message))
        <div class="alert alert-block">
            {!! $message !!}
        </div>
    @endif


    <form id="login-form"class="login-form" method="post" action="{{ route('login') }}">
        {{ csrf_field() }}
        <div class="login-wrap">
            <p class="login-img"><i class="icon_lock_alt"></i></p>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_profile"></i></span>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
            </div>
            @if ($errors->has('email'))
                <span class="help-block text-danger">
                          <strong>{{ $errors->first('email') }}</strong>
                    </span>
            @endif
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input id="password" type="password" name="password" class="form-control" placeholder="Password">
            </div>

            @if ($errors->has('password'))
                <span class="help-block text-danger">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
            @endif

            <label class="checkbox">
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} value="remember-me"> Remember me
                <span class="pull-right" id="forgot"> <a href="{{ url('/password/reset') }}"> Forgot Password?</a></span>
            </label>
            <button id="login-button" class="btn btn-primary btn-lg btn-block disabled" type="submit">Login</button>
            <br>
            <a href="{{ route('register') }}"id="signup-button" class="btn btn-info btn-lg btn-block disabled" >Signup</a>
        </div>
    </form>


</div>


<script src="{{asset('assets/js/site.js')}}"></script>







</body>
</html>
