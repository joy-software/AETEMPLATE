<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Karmanta - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Karmanta, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Reset password</title>

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
    <link href="{{ asset('css/signup.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/login.css') }}" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
    <![endif]-->
</head>

<body class="login-img3-body">

<div class="container">

    @if(\Illuminate\Support\Facades\Session::has('status'))
        <div class="alert alert-block col-lg-9">
            {{ \Illuminate\Support\Facades\Session::get('status') }}
        </div>
    @endif

    <section class="panel" id="section-signup">
        <header class="panel-heading" id="header-signup" >
            <span><i class="icon_refresh"></i></span><span id="form-signup-title">Rénitialisation du mot de passe</span>

        </header>
        <div class="panel-body">
            <div class="form">

                <form class="form-validate form-horizontal " id="register_form" method="post" action="{{ url('/password/reset') }}">
                    {{ csrf_field() }}

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group ">
                        <label for="email" class="control-label col-lg-2">Email <span class="required">*</span></label>
                        <div class="col-lg-9">
                            <input class="form-control " id="email" name="email" type="email" value="{{ old('email') }}" required/>
                        </div>
                        @if ($errors->has('email'))
                            <span class="help-block ">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group ">
                        <label for="password" class="control-label col-lg-2">Mot de passe <span class="required">*</span></label>
                        <div class="col-lg-9">
                            <input class="form-control " id="password" name="password" type="password" value="{{ old('password') }}" required/>
                        </div>
                        @if ($errors->has('password'))

                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="control-label col-lg-2">Confirmer mot de passe<span class="required">*</span></label>

                        <div class="col-lg-9">
                            <input id="password_confirmation" type="password" value="{{ old('password_confirmation') }}" class="form-control" name="password_confirmation" required>
                        </div>
                        @if ($errors->has('password_confirmation'))

                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>


                        <div class="col-lg-offset-2 col-lg-9" id="signup-submit">
                            <button  class="btn btn-primary" type="submit">Enregistrer</button>
                            <a class="btn btn-default" type="button" href="{{ route('login') }}">Fermer</a>
                        </div>

                </form>
            </div>
        </div>
    </section>



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