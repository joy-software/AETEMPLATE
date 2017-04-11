<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Karmanta - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Karmanta, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Login Page 2 | Karmanta - Bootstrap 3 Responsive Admin Template</title>

    <!-- Bootstrap CSS -->
    <link href="{{ asset('karmanta/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <!-- bootstrap theme -->
    <link href="{{ asset('karmanta/css/bootstrap-theme.css') }}" rel="stylesheet"/>
    <!--external css-->
    <!-- font icon -->
    <link href="{{ asset('karmanta/css/elegant-icons-style.css') }}" rel="stylesheet" />
    <link href="../wamp64/www/promovogt.org/resources/assets/karmanta/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="{{ asset('karmanta/css/style.css') }}" rel="stylesheet"/>
    <link href="{{ asset('karmanta/css/style-responsive.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/login.css') }}" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>

    <![endif]-->
</head>

<body class="login-img3-body">

<div class="container">

    <form id="login-form"class="login-form" method="post" action="{{ route('login') }}">
        {{ csrf_field() }}
        <div class="login-wrap">
            <p class="login-img"><i class="icon_lock_alt"></i></p>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_profile"></i></span>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
            </div>
            @if ($errors->has('email'))
                <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                    </span>
            @endif
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input id="password" type="password" name="password" class="form-control" placeholder="Password">
            </div>

            @if ($errors->has('password'))
                <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
            @endif

            <label class="checkbox">
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} value="remember-me"> Remember me
                <span class="pull-right"> <a href="{{ url('/password/reset') }}"> Forgot Password?</a></span>
            </label>
            <button id="login-button" class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
            <br>
            <a href="{{ route('register') }}"id="signup-button" class="btn btn-info btn-lg btn-block" >Signup</a>
        </div>
    </form>


</div>


<script src="{{ asset('karmanta/js/html5shiv.js') }}"></script>
<script src="{{ asset('karmanta/js/custom.js') }}"></script>
<script src="{{ asset('karmanta/js/respond.min.js') }}"></script>
<script src="{{ asset('karmanta/js/jquery.js') }}"></script>
<script src="{{ asset('karmanta/js/jquery-1.8.3.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('karmanta/js/jquery-ui-1.9.2.custom.min.js') }}"></script>
<!-- bootstrap -->
<script src="{{ asset('karmanta/js/bootstrap.min.js') }}"></script>
<!-- nice scroll -->
<script src="{{ asset('karmanta/js/jquery.scrollTo.min.js') }}"></script>
<script src="{{ asset('karmanta/js/jquery.nicescroll.js') }}" type="text/javascript"></script>
<!-- charts scripts -->
<script src="{{ asset('karmanta/assets/jquery-knob/js/jquery.knob.js') }}"></script>
<script src="{{ asset('karmanta/js/jquery.sparkline.js') }}" type="text/javascript"></script>
<script src="{{ asset('karmanta/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js') }}"></script>
<script src="{{ asset('karmanta/js/owl.carousel.js') }}" ></script>
<!-- jQuery full calendar -->
<script src="{{ asset('karmanta/assets/fullcalendar/fullcalendar/fullcalendar.min.js') }}"></script>
<!--script for this page only-->
<script src="{{ asset('karmanta/js/calendar-custom.js') }}"></script>
<!-- custom select -->
<script src="{{ asset('karmanta/js/jquery.customSelect.min.js') }}" ></script>
<!--custome script for all page-->
<script src="{{ asset('karmanta/js/scripts.js') }}"></script>
<!-- custom script for this page-->
<script src="{{ asset('karmanta/js/sparkline-chart.js') }}"></script>
<script src="{{ asset('karmanta/js/easy-pie-chart.js') }}"></script>
<script src="{{ asset('karmanta/js/custom.js') }}"></script>
</body>
</html>
