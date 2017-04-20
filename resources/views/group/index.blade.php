
@extends('layouts/app')


@section('css')

    <link href="{{ asset('css/displayAside.css') }}" rel="stylesheet">
    <link href="{{ asset('css/avatar.css') }}" rel="stylesheet" />

@endsection

@section('sideOption')
    @include('layouts/asideOptionGenerated')

@endsection



@section('content')


    <section class="wrapper">
        <!--overview start-->
        <div class="row state-overview">
            <div class="col-lg-12">
                <!--user profile info start-->
                <section class="panel">
                    <div class="profile-widget profile-widget-info">
                        <div class="panel-body">
                            <div class="col-lg-1 col-sm-1 profile-widget-name">
                                <h4>John Smith</h4>
                                <div class="follow-ava">
                                    <img src="{{ asset('karmanta/img/profile-widget-avatar.jpg') }}" alt="">
                                </div>
                                <h6>Administrator</h6>
                            </div>
                            <div class="col-lg-8 col-sm-8 follow-info">
                                <p>Bienvenue John, Ce qui s'est passé depuis la dernière fois.</p>
                                <h6>
                                    <span><i class="icon_clock_alt"></i>11:05 AM</span>
                                    <span><i class="icon_calendar"></i>25.10.13</span>
                                    <span><i class="icon_pin_alt"></i>NY</span>
                                </h6>
                            </div>
                            <div class="weather-category twt-category">
                                <ul>
                                    <li class="active col-lg-3">
                                        <h4>5</h4>
                                        <i class="icon_close_alt2"></i> Evènements
                                    </li>
                                    <li class="col-lg-3">
                                        <h4>4</h4>
                                        <i class="icon_check_alt2 "></i> Annonces
                                    </li>
                                    <li class="col-lg-3">
                                        <h4>1</h4>
                                        <i class="icon_plus_alt2 "></i> Réunions
                                    </li>
                                    <li class="col-lg-3">
                                        <h4>3</h4>
                                        <i class="icon_plus_alt2 col-lg-3"></i> Demandes d'adhésion
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </section>
                <!--user profile info end-->
            </div>
            <!-- statics start -->
            <div class="state col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-heading">Promotion 96</div>
                    <div class="panel-body">

                        <div class="weather-category twt-category">
                            <ul>
                                <li class="active col-lg-3">
                                    <h4>7</h4>
                                    <i class="icon_close_alt2"></i> Evènements
                                </li>
                                <li class="col-lg-3">
                                    <h4>0</h4>
                                    <i class="icon_check_alt2 "></i> Annonces
                                </li>

                                <li class="col-lg-3">
                                    <h4>1</h4>
                                    <i class="icon_plus_alt2 col-lg-3"></i> Demandes d'adhésion
                                </li>
                                <li>
                                    <button class="btn btn-primary btnViewGroup">Voir</button>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>


                <div class="panel panel-default">
                    <div class="panel-heading">
                        Kangourou
                    </div>
                    <div class="panel-body">

                        <div class="weather-category twt-category">
                            <ul>
                                <li class="active col-lg-3">
                                    <h4>2</h4>
                                    <i class="icon_close_alt2"></i> Evènements
                                </li>
                                <li class="col-lg-3">
                                    <h4>3</h4>
                                    <i class="icon_check_alt2 "></i> Annonces
                                </li>

                                <li class="col-lg-3">
                                    <h4>0</h4>
                                    <i class="icon_plus_alt2 col-lg-3"></i> Demandes d'adhésion
                                </li>
                                <li>
                                    <button class="btn btn-primary btnViewGroup">Voir</button>
                                </li>


                            </ul>
                        </div>
                    </div>

                </div>
            </div>

        </div>


    </section>

@endsection