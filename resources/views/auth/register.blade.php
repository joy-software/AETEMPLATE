<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Site des anciens élèves du Collège Vogt">
    <meta name="author" content="LACY 2017">
    <meta name="keyword" content="Promo-vogt, alumni, anciens, vogtois, anciens vogtois">
    <link rel="shortcut icon" href={!! url('cache/original/'."img/favicon.png") !!}>

    <title>Inscription | PromotVogt</title>


    <link href="{{ asset('assets/css/site.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/signup.css') }}" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
    <script src="{{ asset('js/kar.js') }}"></script>
    <![endif]-->
    <script type="text/javascript">
        var onloadCallback = function() {
            grecaptcha.render('g-reCAPTCHA', {
                'sitekey' : '{{ env('SETTINGS_GOOGLE_RECAPTCHA_SITE_KEY') }}',
                'type' : 'audio'
            });
        };
    </script>
</head>

<body class="login-img3-body">

<div class="container">

    @if(\Illuminate\Support\Facades\Session::has('message'))
        <div class="alert alert-block ">
            {!! \Illuminate\Support\Facades\Session::get('message') !!}
        </div>
    @else
        <section class="panel col-sm-4 col-md-4 col-lg-4 col-xs-4" id="section-signup">
            <header class="panel-heading" id="header-signup" >
                <span><i class="icon_pencil-edit"></i></span><span id="form-signup-title">INSCRIVEZ  VOUS</span>

            </header>
            <div class="panel-body">
                <div class="form">

                    <form class="form-validate form-horizontal " enctype="multipart/form-data" id="register_form" method="post" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <div class="form-group ">
                            <!--
                            <label for="surname" class="control-label col-lg-2">Prénom <span class="required">*</span></label>
                            -->
                            <div class="col-lg-12">
                                <input class=" form-control" id="surname" name="surname" type="text" value="{{ old('surname') }}" placeholder="Prénom" required/>
                            </div>
                            @if ($errors->has('surname'))
                                <span class="help-block control-label col-lg-12  text-danger">
                            <strong>{{ $errors->first('surname') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group ">
                             <!--
                            <label for="name" class="control-label col-lg-2">Nom <span class="required">*</span></label>
                            -->
                            <div class="col-lg-12">
                                <input class=" form-control" id="name" placeholder="Nom" name="name" type="text" value="{{ old('name') }}" required/>
                            </div>
                            @if ($errors->has('name'))
                                <span class="help-block control-label col-lg-12  text-danger">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                            @endif
                        </div>

                        <div class="form-group ">
                            <div class="col-lg-12">
                                <select class="form-control" name="sex" id="sex" required>
                                    @if(! (old('sex')))
                                        <option value="" selected>Genre</option>
                                    @endif
                                    <option value="M"   @if( old('sex') == 'M')
                                                            selected>Homme</option>
                                                        @else
                                                            >Homme</option>
                                                        @endif

                                    <option value="F"   @if( old('sex') == 'F')
                                                            selected>Femme</option>
                                                        @else
                                                            >Femme</option>
                                                        @endif

                                </select>
                            </div>

                            @if ($errors->has('sex'))
                                <span class="help-block control-label col-lg-12  text-danger ">
                                    <strong>{{ $errors->first('sex') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group ">
                        <!--
                            <label for="email" class="control-label col-lg-2">Email <span class="required">*</span></label>
                            -->
                            <div class="col-lg-12">
                                <input class="form-control " id="email" placeholder="Email" name="email" type="email" value="{{ old('email') }}" required/>
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block control-label col-lg-12  text-danger ">
                                     <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>


                        <div class="form-group ">
                        <!--
                            <label for="phone" class="control-label col-lg-2">Telephone <span class="required">*</span></label>
                            -->
                            <div class="col-lg-12">
                                <input class="form-control " id="phone" name="phone" placeholder="Téléphone" type="text" value="{{ old('phone') }}" required/>
                            </div>
                            @if ($errors->has('phone'))
                                <span class="help-block control-label col-lg-12  text-danger">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>


                        <div class="form-group ">
                            <div class="col-lg-12">
                                <select class="form-control" name="promotion" id="promotion" required>
                                    @if(! (old('promotion')))
                                        <option value="" selected>Promotion</option>
                                    @endif

                                    @if(old('promotion'))
                                        <option value="{{ old('promotion') }}" selected>{{old('promotion')}}</option>
                                    @endif

                                    @for($i = date('Y'); $i > 1960; $i--)
                                            <option value="{!! $i !!}">{{ $i }}</option>
                                    @endfor

                                </select>
                            </div>
                            @if ($errors->has('promotion'))
                                <span class="help-block control-label col-lg-12  text-danger ">
                                    <strong>{{ $errors->first('promotion') }}</strong>
                                </span>
                            @endif
                        </div>


                        <div class="form-group ">
                            <div class="col-lg-12">
                                <select class="form-control" name="country" id="county" required>

                                    @if(! (old('country')))
                                        <option value="" selected>Pays</option>
                                        <option value="Cameroun">Cameroun</option>
                                    @else
                                        <option value="{{old('country')}}" selected>{{old('country')}}</option>
                                    @endif

                                    {!! Config::get('country.completeList') !!}

                                </select>
                            </div>
                            @if ($errors->has('country'))
                                <span class="help-block control-label col-lg-12  text-danger ">
                                    <strong>{{ $errors->first('country') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group ">

                            <div class="col-lg-12">
                                <input class="form-control " id="profession" placeholder="Profession" name="profession" type="text" value="{{ old('profession') }}" required/>
                            </div>
                            @if ($errors->has('profession'))
                                <span class="help-block control-label col-lg-12  text-danger">
                                    <strong>{{ $errors->first('profession') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group ">

                            <div class="col-lg-12">
                                <textarea class="form-control" cols="30" rows="5" placeholder="Décrivez vous en quelques mots (max 150 caractères)" name="description" id="description" required>{{ old('description') }}</textarea>
                            </div>
                            @if ($errors->has('description'))
                                <span class="help-block control-label col-lg-12  text-danger">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                            @endif
                        </div>


                        <div class="form-group ">

                            <div class="col-lg-12">
                                <input class="form-control " placeholder="Mot de passe" id="password" name="password" type="password" value="{{ old('password') }}" required/>
                            </div>
                            @if ($errors->has('password'))

                                <span class="help-block control-label col-lg-12  text-danger">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">

                            <div class="col-lg-12">
                                <input id="password_confirmation" placeholder="Confirmer le mot de passe" type="password" value="{{ old('password_confirmation') }}" class="form-control" name="password_confirmation" required>
                            </div>
                            @if ($errors->has('password_confirmation'))

                                <span class="help-block control-label col-lg-12  text-danger">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                            @endif
                        </div>

                        <div class="form-group ">

                            <div class="col-lg-4 col-xs-12">
                                {!! Form::file('photo', ['class' => 'form-control col-lg-4  inputfile', 'id' => 'photo']) !!}
                                <label for="photo" class="btn btn-primary"><i class="icon_upload"></i><span id="label-file">Choisissez une photo</span></label>
                            </div>

                            <p class="control-label photo-label ">Extensions acceptées : jpg, jpeg, png (2Mo maxi)</p>

                            @if ($errors->has('photo'))
                                <span class="help-block control-label col-lg-12  text-danger">
                                    <strong>{{ $errors->first('photo') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group ">
                            <div id="g-reCAPTCHA" class="col-lg-12"></div>
                            @if ($errors->has('captcha-verified'))

                                <span class="help-block control-label col-lg-12  text-danger">
                            <strong>{{ $errors->first('captcha-verified') }}</strong>
                        </span>
                            @endif
                           @if ($errors->has('g-recaptcha-response'))

                                <span class="help-block control-label col-lg-12  text-danger">
                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                        </span>
                            @endif
                        </div>
                         <div class="form-group ">

                            <div class="col-lg-12">

                                <input  type="checkbox" style="float: left; width: 20px" value="true" class="checkbox form-control" id="agree" name="agree" required
                                    @if(old('agree') == 'true')
                                        checked
                                    @endif
                                />
                                <label id="label-condidtion" for="agree" class="control-label "><a href="#">Accepter les conditions d'utilisation</a> </label>
                            </div>

                            @if ($errors->has('agree'))

                                <span class="help-block control-label col-lg-12  text-danger">
                            <strong>{{ $errors->first('agree') }}</strong>
                        </span>
                            @endif
                        </div>
                        <div class="form-group" >
                            <div class=" col-lg-12" id="signup-submit">
                                <button  class="btn btn-primary" type="submit">S'inscrire</button>
                                <a class="btn btn-default" type="button" href="{{ route('login') }}">Fermer</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </section>

        <div class="login-wrap slogan-signup">
            <span >Promot-vogt</span>

            <span style="color: black; margin-top: 10%; display: inline-block">Beyond limits and time !</span>

        </div>
    @endif


</div>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
</script>

<script src="{{asset('assets/js/site.js')}}"></script>
<script src="{{ asset('assets/js/upload.js') }}"></script>

</body>
</html>