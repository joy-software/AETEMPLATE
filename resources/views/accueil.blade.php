
@extends('layouts.app')


@section('css')

    <link href="{{ asset('css/deleteAside.css') }}" rel="stylesheet">
    <link href="{{ asset('css/avatar.css') }}" rel="stylesheet"/>

@endsection

@section('sideOption')
    @include('layouts/asideOption', [

                'classIconOption' => 'icon_house_alt',
                'optionName' => 'Assemblée générale',
                'retractable' => 'true',
                'link' => url('profile'),
                'subOptions' => [['link' => 'javascript:', 'name' => 'Voir les membres'],
                                 ['link' => 'javascript:', 'name' => 'Créer un évènement'],
                                 ['link' => 'javascript:', 'name' => 'Créer une annonce'],
                                 ['link' => 'javascript:', 'name' => 'Options']
                ]

            ])

    @include('layouts/asideOption', [

        'classIconOption' => 'icon_table',
        'optionName' => 'Promotion 96',
        'retractable' => 'true',
        'link' => 'javascript:',
        'subOptions' => [['link' => 'javascript:', 'name' => 'Voir les membres'],
                         ['link' => 'javascript:', 'name' => 'Créer un évènement'],
                         ['link' => 'javascript:', 'name' => 'Créer une annonce'],
                         ['link' => 'javascript:', 'name' => 'Options']
        ]

    ])

    @include('layouts/asideOption', [

        'classIconOption' => 'icon_piechart',
        'optionName' => 'Kongourou',
        'link' => 'javascript:',
        'retractable' => 'true',
        'subOptions' => [['link' => 'javascript:', 'name' => 'Voir les membres'],
                         ['link' => 'javascript:', 'name' => 'Créer un évènement'],
                         ['link' => 'javascript:', 'name' => 'Créer une annonce'],
                         ['link' => 'javascript:', 'name' => 'Options']
        ]
    ])

    @include('layouts/asideOption', [

        'classIconOption' => 'icon_documents_alt',
        'optionName' => 'Rechercher un groupe',
        'link' => 'javascript:',
        'retractable' => 'true',
        'subOptions' => [['link' => 'javascript:', 'name' => 'Voir les membres'],
                         ['link' => 'javascript:', 'name' => 'Créer un évènement'],
                         ['link' => 'javascript:', 'name' => 'Créer une annonce'],
                         ['link' => 'javascript:', 'name' => 'Options']
        ]
    ])
@endsection


@section('content')
    @if(\Illuminate\Support\Facades\Session::has('success'))
        <div class="alert alert-success"> {{ Session::get('success') }} </div>
    @endif

    <section class="wrapper">
        <!--overview start-->
        <div class="row state-overview">
            <div class="col-lg-12">
                <!--user profile info start-->
                <section class="panel">
                    <div class="row">
                        <div class="col-lg-9 col-sm-9">
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
                        </div>
                        <div class="col-lg-3 col-sm-3">
                            <div class="panel panel-primary">
                                <div class="panel-heading text-center">Contribution</div>
                                <div class="panel-content">
                                    <div class="panel-body">
                                        <form role="form">
                                            <div class="form-group">
                                                <span class="badge bg-warning hidden">Vous n'avez pas encore contribué pour ce mois</span>
                                                <!--input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email"-->
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="Contribution" class="badge bg-success center-block ">Votre Contribution de ce mois</label>
                                                <!--label for="Contribution" class="badge bg-info">15000</label-->
                                            <br/>
                                            <br/>

                                                <input type="number" class="form-control text-center" id="contribution" placeholder="15000" disabled>

                                            </div>
                                            <button type="submit" class="btn btn-compose center-block hidden">Contribuer pour ce mois</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--user profile info end-->
            </div>
            <!-- statics start -->
            <div class="state col-lg-12">

                @include('layouts.group',[
                'groupname' => 'Promotion 2012' ,
                'nbr_event' => 12,
                'nbr_ads' => 5,
                'nbr_mem' => 7])

                @include('layouts.group',[
                'groupname' => 'Kangourou' ,
                'nbr_event' => 7,
                'nbr_ads' => 4,
                'nbr_mem' => 2])
            </div>

        </div>


    </section>

@endsection