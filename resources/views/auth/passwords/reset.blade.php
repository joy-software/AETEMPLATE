<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Site des anciens élèves du Collège Vogt">
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

    <title>Reinitialisation | PromotVogt</title>


    <!-- Custom styles -->
    <link href="{{ asset('assets/css/site2.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/signup.css') }}" rel="stylesheet" />
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
    <script src="{{ asset('js/kar.js') }}"></script>
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
                            <button  class="btn btn-primary disabled" type="submit">Enregistrer</button>
                            <a class="btn btn-default disabled" type="button" href="{{ route('login') }}">Fermer</a>
                        </div>

                </form>
            </div>
        </div>
    </section>



</div>



<script src="{{asset('assets/js/site.js')}}"></script>
</body>
</html>