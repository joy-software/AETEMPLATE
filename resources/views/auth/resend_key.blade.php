<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Site des anciens élèves du Collège Vogt">
    <meta name="author" content="LACY 2017">
    <meta name="keyword" content="Promo-vogt, alumni, anciens, vogtois, anciens vogtois">
    <link rel="shortcut icon" href={!! url('cache/original/PVlogo.jpeg') !!}>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        // rename myToken as you like
        window.Laravel ={!! json_encode([
              'csrfToken' => csrf_token(),
        ]) !!};
        var userId = {!! json_encode( Auth::id()) !!};

    </script>

    <title>Activation | PromotVogt</title>



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
        <div class="alert alert-block">
            {!!  \Illuminate\Support\Facades\Session::get('message') !!}
        </div>
    @endif

    @if (isset($message))
        <div class="alert alert-block">
            {!! $message !!}
        </div>
    @endif



    <form id="login-form"class="login-form" method="post" action="{{ route('activation_key_resend') }}">
        {{ csrf_field() }}
        <div class="login-wrap">
            <p class="login-img litle"><i class="icon_refresh"></i></p>
            <p id="resend-title">Générer une nouveau lien d'activation </p>

        <div class="input-group">
                <span class="input-group-addon"><i class="icon_profile"></i></span>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
            </div>
            @if ($errors->has('email'))
                <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                    </span>
            @endif


            <button id="login-button" class="btn btn-primary btn-lg btn-block disabled" type="submit">Envoyer</button>

        </div>
    </form>


</div>



<script src="{{asset('assets/js/site.js')}}"></script>
</body>
</html>
