
@extends('layouts.app')


@section('css')

    <link href="{{ asset('css/deleteAside.css') }}" rel="stylesheet">
    <link href="{{ asset('css/avatar.css') }}" rel="stylesheet"/>

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
                                        <h4>{{$user->surname}}</h4>
                                        <div class="follow-ava">
                                            <img src="{{ url($user->photo) }}" alt="photo" style="background-color: white">
                                        </div>
                                        @role('admin_1')
                                        <h6>Administrateur</h6>
                                        @endrole()
                                    </div>
                                    <div class="col-lg-8 col-sm-8 follow-info">
                                        <p>{{$user->description}}</p>
                                        <h6>
                                            <span><i class="icon_clock_alt"></i>{{$date->toTimeString() }}</span>
                                            <span><i class="icon_calendar"></i>{{$date->toDateString()}}</span>
                                            <span><i class="icon_pin_alt"></i>{{$user->country}}</span>
                                        </h6>
                                    </div>
                                    <div class="weather-category twt-category">
                                        <ul>
                                            <li class="active col-lg-3">
                                                <h4>{{$nbr_event_A}}</h4>
                                                <i class="icon_close_alt2"></i> Evènements
                                            </li>
                                            <li class="col-lg-3">
                                                <h4>{{$nbr_ads_A}}</h4>
                                                <i class="icon_check_alt2 "></i> Annonces
                                            </li>
                                            <li class="col-lg-3">
                                                <h4>{{$nbr_meet_A}}</h4>
                                                <i class="icon_plus_alt2 "></i> Réunions
                                            </li>
                                            <li class="col-lg-3">
                                                <h4>{{$nbr_mem_A}}</h4>
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
            <!-- dynamic start -->
            <div class="state col-lg-12">

                @foreach($user_groups as $user_group)
                    @include('layouts.group',[
                    'groupname' => $name_groups[$user_group['group_ID']] ,
                    'nbr_event' => $nbr_event_group[$user_group['group_ID']],
                    'nbr_ads' => $nbr_ads_group[$user_group['group_ID']],
                    'nbr_mem' => $nbr_mem_group[$user_group['group_ID']]])

                @endforeach
            </div>

        </div>


    </section>

@endsection