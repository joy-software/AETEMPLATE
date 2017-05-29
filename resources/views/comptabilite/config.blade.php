@extends('layouts/app')

@section('css')

    <link href="{{ asset('assets/css/comptabilite.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/deleteAside.css') }}" rel="stylesheet">
    @role("comptable")
    <link href="{{ asset('assets/css/displayAside.css') }}" rel="stylesheet">
    @endrole()

@endsection
@section('title')
    Contribuer | Promot Vogt
@endsection



@role("comptable")
@section('sideOption')
    @include('layouts/asideOption', [
                'classIconOption' => 'icon_house_alt',
                'optionName' => 'Accueil des contributions',
                'retractable' => 'false',
                'link' => url('/comptabilite')
            ])

    @include('layouts/asideOption', [
            'classIconOption' => 'icon_search',
            'optionName' => 'Consulter les contributions',
            'retractable' => 'false',
            'link' => url('/comptabilite/consult_contribution')
        ])

    @include('layouts/asideOption', [
           'classIconOption' => 'icon_mobile',
           'optionName' => 'Config Paiement Mobile',
           'retractable' => 'false',
           'link' => url('/comptabilite/config_momo')
       ])


@endsection
@endrole


@section('content')

    <section class="wrapper " id="wrapper-content">


        <div class="row">
            <div class="col-lg-offset-1 col-lg-10 col-md-10 col-sm-10" id="div_message">

            </div>
        </div>
            <div  style="background: white;">

                    @if($avatar->hasRole("comptable"))
                        <div class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-5 col-sm-offset-4 col-md-offset-4" >
                     @else
                        <div class="col-lg-3 col-md-4 col-sm-4 col-lg-offset-5 col-sm-offset-4 col-md-offset-4" >
                    @endif
                        <section class="panel">
                            <header class="panel-heading text-center">
                                Changer les paramètres du compte Mobile Money Online
                            </header>

                            <div class="list-group">
                                {!! Form::open(array('route' => 'post_config_momo', 'id'=> 'post_config_momo', 'method'=>'post')) !!}
                                <a class="list-group-item" style=" background: white;">Entrer l'adresse email de votre compte :<br><br>
                                    <input type="email" class="form-control" name="email_membre" required id="email_membre" value="{{env('MERCHAND_EMAIL')}}">
                                </a>
                                <a class="list-group-item" style=" background: white;" id="password" >Mot de Passe :<br><br>
                                    <input type="password" class="form-control" name="password" required id="password" value="{{env('MERCHAND_PASSWORD')}}">
                                </a>

                                <div class="form-group " id="button_contrib">
                                    <br/>
                                    <button  id="btn_post_config_momo" class="btn btn-compose center-block disabled" style="width:100px;background-color: #ff2d55!important;" >Enregistrer</button>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </section>
                    </div>
        </div>

    </section>

@endsection



@section('script')
    <script src="{{ asset('assets/js/comptabilite.js') }}"></script>
@endsection