@extends('layouts/app')

@section('css')

    <link href="{{ asset('assets/css/deleteAside.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/profile.css') }}" rel="stylesheet">


@endsection



@section('content')


    <section class="wrapper">
            <div class="row">
                <!-- profile-widget -->
                <div class="col-lg-12">
                    <div class="profile-widget profile-widget-info">
                        <div class="panel-body">
                            <div class="col-lg-2 col-sm-2">

                                <div class="follow-ava">
                                    <img src="{{ url('cache/logo/'.Auth::user()->photo) }}" alt="" style="background-color: white;">

                                </div>

                                <h4>
                                    @if(\Illuminate\Support\Facades\Auth::check())
                                        {{ \Illuminate\Support\Facades\Auth::user()->surname  }}@endif
                                </h4>

                            </div>

                            <div class="col-lg-4 col-sm-4 follow-info">

                                <p>@if(\Illuminate\Support\Facades\Auth::check())
                                        {{ \Illuminate\Support\Facades\Auth::user()->email  }}@endif</p>
                                <h6>
                                    <span><i class="icon_clock_alt"></i>{{date('H : i')}}</span>
                                    <span><i class="icon_calendar"></i>{{ date('d . m . Y') }}</span>
                                </h6>
                            </div>

                            <div class="col-lg-6 col-sm-6 follow-info weather-category">
                                <ul class="recapitulatif">
                                    <li class="active">
                                        <h4>{{$nbr_ads}}</h4>
                                        <i class="icon_close_alt2"></i> Annonces
                                    </li>
                                    <li>
                                        <h4>{{$nbr_event}}</h4>
                                        <i class="icon_check_alt2"></i> Evènements
                                    </li>
                                    <li>
                                        <h4>{{$nbr_mem}}</h4>
                                        <i class="icon_plus_alt2"></i> Adhésions validées
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading tab-bg-info">
                            <ul class="nav nav-tabs">

                                <li class="active">
                                    <a data-toggle="tab" href="#profile">
                                        <i class="icon-user"></i>
                                        Mon profil
                                    </a>
                                </li>
                                <li class="">
                                    <a data-toggle="tab" href="#edit-profile">
                                        <i class="icon-envelope"></i>
                                        Editer mon profil
                                    </a>
                                </li>
                                <li class="">
                                    <a data-toggle="tab" href="#edit-credential">
                                        <i class="icon-envelope"></i>
                                        Paramètres de connexion
                                    </a>
                                </li>
                            </ul>
                        </header>

                        <div class="panel-body">

                            <div class="tab-content">

                                <div id="profile" class="tab-pane active">
                                    <section class="panel">
                                        <div class="bio-graph-heading">
                                            @if(\Illuminate\Support\Facades\Auth::check())
                                                {{ \Illuminate\Support\Facades\Auth::user()->description }}
                                            @endif

                                        </div>
                                        <div class="panel-body bio-graph-info">
                                            @if(\Illuminate\Support\Facades\Session::has('success'))
                                                <div class="alert alert-success"> {{ Session::get('success') }} </div>
                                            @endif
                                            <div class="row">
                                                <div class="bio-row">
                                                    <p><span>Prénom </span>
                                                        @if(\Illuminate\Support\Facades\Auth::check())
                                                            {{ \Illuminate\Support\Facades\Auth::user()->surname }}
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="bio-row">
                                                    <p><span>Nom </span>
                                                        @if(\Illuminate\Support\Facades\Auth::check())
                                                            {{ \Illuminate\Support\Facades\Auth::user()->name }}
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="bio-row">
                                                    <p><span>Email</span>
                                                        @if(\Illuminate\Support\Facades\Auth::check())
                                                            {{ \Illuminate\Support\Facades\Auth::user()->email }}
                                                        @endif
                                                    </p>
                                                </div>

                                                <div class="bio-row">
                                                    <p><span>Genre</span>
                                                        @if(\Illuminate\Support\Facades\Auth::check())
                                                            @if(\Illuminate\Support\Facades\Auth::user()->sex == 'M')
                                                                {{ 'Homme' }}

                                                            @elseif(\Illuminate\Support\Facades\Auth::user()->sex == 'F')
                                                                {{ 'Femme' }}
                                                            @endif
                                                        @endif
                                                    </p>
                                                </div>

                                                <div class="bio-row">
                                                    <p><span>Telephone </span>
                                                        @if(\Illuminate\Support\Facades\Auth::check())
                                                            {{ \Illuminate\Support\Facades\Auth::user()->phone }}
                                                        @endif
                                                    </p>
                                                </div>

                                                <div class="bio-row">
                                                    <p><span>Promotion </span>
                                                        @if(\Illuminate\Support\Facades\Auth::check())
                                                            {{ \Illuminate\Support\Facades\Auth::user()->promotion }}
                                                        @endif
                                                    </p>
                                                </div>

                                                <div class="bio-row">
                                                    <p><span>Profession </span>
                                                        @if(\Illuminate\Support\Facades\Auth::check())
                                                            {{ \Illuminate\Support\Facades\Auth::user()->profession }}
                                                        @endif
                                                    </p>
                                                </div>

                                                <div class="bio-row">
                                                    <p><span>Pays </span>
                                                        @if(\Illuminate\Support\Facades\Auth::check())
                                                            {{ \Illuminate\Support\Facades\Auth::user()->country }}
                                                        @endif
                                                    </p>
                                                </div>

                                            </div>

                                        </div>
                                    </section>
                                    <section>
                                        <div class="row">
                                        </div>
                                    </section>
                                </div>


                                <div id="edit-profile" class="tab-pane">

                                    <section class="panel">
                                        <div class="panel-body bio-graph-info">

                                            {!! Form::open(
                                                        array(
                                                            'route' => 'editProfile',
                                                            'class' => 'form-horizontal',
                                                            'files' => true)) !!}

                                                {{ csrf_field() }}
                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label">Prénom</label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control"  placeholder=" " name="surname" @if(\Illuminate\Support\Facades\Auth::check())
                                                        {{ 'value='.(\Illuminate\Support\Facades\Auth::user()->surname)  }}@endif>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label">Nom</label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" id="name" placeholder=" " name="name" @if(\Illuminate\Support\Facades\Auth::check())
                                                            {{ 'value='.(\Illuminate\Support\Facades\Auth::user()->name)  }}@endif>
                                                    </div>
                                                </div>

                                                <div class="form-group ">

                                                    <label for="sex" class="control-label col-lg-2">Genre <span class="required">*</span></label>
                                                    <div class="col-lg-6">
                                                        <select class="form-control" name="sex" id="sex">
                                                            @if (\Illuminate\Support\Facades\Auth::user()->sex == 'M')

                                                                    <option value="M" selected>Homme</option>
                                                                    <option value="F">Femme</option>

                                                            @else

                                                                <option value="M" >Homme</option>
                                                                <option value="F" selected>Femme</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                    @if ($errors->has('sex'))
                                                        <span class="help-block ">
                                                            <strong>{{ $errors->first('sex') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>


                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label">Telephone</label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" id="phone" placeholder=" " name="phone" @if(\Illuminate\Support\Facades\Auth::check())
                                                            {{'value=' . Auth::user()->phone}}@endif>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label">Promotion</label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" id="promotion" placeholder=" " name="promotion" @if(\Illuminate\Support\Facades\Auth::check())
                                                            {{ 'value='.(\Illuminate\Support\Facades\Auth::user()->promotion) }}@endif>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label">Pays</label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" id="country" placeholder=" " name="country" @if(\Illuminate\Support\Facades\Auth::check())
                                                            {{ 'value='.(\Illuminate\Support\Facades\Auth::user()->country)  }}@endif>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label">Profession</label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" id="profession" placeholder=" " name="profession" @if(\Illuminate\Support\Facades\Auth::check())
                                                            {{ 'value='.(\Illuminate\Support\Facades\Auth::user()->profession)  }}@endif>
                                                    </div>
                                                </div>



                                                <div class="form-group ">

                                                    <label for="photo" class="control-label col-lg-2">Photo</label>
                                                    <div class="col-lg-4">
                                                        {!! Form::file('photo', ['class' => 'form-control col-lg-4 inputfile', 'id' => 'photo']) !!}
                                                        <label for="photo" class="btn btn-primary"><i class="icon_upload"></i><span id="label-file">Choisissez une photo</span></label>
                                                    </div>

                                                    <p class="control-label photo-label col-lg-offset-2">Extensions acceptées : jpeg, png (2Mo maxi)</p>

                                                    @if ($errors->has('photo'))
                                                        <span class="help-block control-label col-lg-9 col-lg-offset-2 text-danger">
                                                            <strong>{{ $errors->first('photo') }}</strong>
                                                        </span>
                                                    @endif

                                                </div>


                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label">A propos de moi</label>
                                                    <div class="col-lg-6">
                                                        @if(\Illuminate\Support\Facades\Auth::check())
                                                        <textarea name="description" id="description" class="form-control" cols="30" rows="5">{{\Illuminate\Support\Facades\Auth::user()->description}}
                                                        </textarea>
                                                        @else
                                                            <textarea name="description" id="description" class="form-control" cols="30" rows="5">
                                                        </textarea>

                                                        @endif
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <div class="col-lg-offset-2 col-lg-10">
                                                        <button id="profileButton" type="submit" class="btn btn-primary">Enregistrer</button>

                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </section>
                                </div>


                                <div id="edit-credential" class="tab-pane">
                                    <section class="panel">
                                        <div class="panel-body bio-graph-info">

                                            <form class="form-horizontal" enctype="multipart/form-data" role="form" method="post" action="{{ route('editCredential') }}">
                                                {{ csrf_field() }}

                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label">Ancien mot de passe</label>
                                                    <div class="col-lg-6">
                                                        <input type="password" class="form-control" id="old_password" placeholder=" " name="old_password" >
                                                    </div>
                                                    @if ($errors->has('old_password'))
                                                        <span class="help-block col-lg-offset-2 text-danger bott">
                                                            <strong>{{ $errors->first('old_password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>


                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label">Email</label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" id="email" placeholder=" " name="email" @if(\Illuminate\Support\Facades\Auth::check())
                                                            {{ 'value='.(\Illuminate\Support\Facades\Auth::user()->email)  }}@endif>
                                                    </div>
                                                    @if ($errors->has('email'))
                                                        <span class="help-block col-lg-offset-2 text-danger bott">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif

                                                </div>


                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label">Nouveau mot de passe</label>
                                                    <div class="col-lg-6">
                                                        <input type="password" class="form-control" id="new_password" placeholder=" " name="new_password" >
                                                    </div>
                                                    @if ($errors->has('new_password'))
                                                        <span class="help-block col-lg-offset-2 text-danger bott">
                                                            <strong>{{ $errors->first('new_password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>



                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label">Confirmer le nouveau mot de passe</label>
                                                    <div class="col-lg-6">
                                                        <input type="password" class="form-control" id="password_confirmation" placeholder=" " name="password_confirmation" >
                                                    </div>
                                                    @if ($errors->has('password_confirmation'))
                                                        <span class="help-block col-lg-offset-2 text-danger bott">
                                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>



                                                <div class="form-group">
                                                    <div class="col-lg-offset-2 col-lg-10">
                                                        <button id="profileButton" id="credential-submit" type="submit" class="btn btn-primary">Enregistrer</button>

                                                    </div>
                                                </div>


                                            </form>
                                        </div>
                                    </section>
                                </div>


                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <!-- page end-->
        </section>

@endsection


<script>

    //knob
    $(".knob").knob();

</script>

@section('script')

    <script src="{{ asset('js/profile.js') }}"></script>
    <script src="{{ asset('js/upload.js') }}"></script>

@endsection

</body>
</html>
