
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
                <section class="panel"  style="background-color: #eeeeee!important;">
                    <div class="row" >
                        <div class="col-lg-9 col-sm-9" >
                            <div class="profile-widget profile-widget-info " >
                                <div class="panel-body" >
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
                                        <p style="text-overflow: clip">{{$user->description}}</p>

                                        <h6>
                                            <span><i class="icon_clock_alt"></i>{{$date->toTimeString() }}</span>
                                            <span><i class="icon_calendar"></i>{{$date->toDateString()}}</span>
                                            <span><i class="icon_pin_alt"></i>{{$user->country}}</span>
                                        </h6>
                                    </div>

                                    <div class="weather-category twt-category">

                                        <ul>
                                            <li class="active col-lg-3 col-sm-3">
                                                <h4>{{$nbr_event_A}}</h4>
                                                <i class="icon_calendar"></i> Evènements
                                            </li>
                                            <li class="col-lg-3 col-sm-3">
                                                <h4>{{$nbr_ads_A}}</h4>
                                                <i class="icon_chat "></i> Annonces
                                            </li>
                                            <li class="col-lg-3 col-sm-3">
                                                <h4>{{$nbr_meet_A}}</h4>
                                                <i class="icon_genius"></i> Réunions
                                            </li>
                                            <li class="col-lg-3 col-sm-3">
                                                <h4>{{$nbr_mem_A}}</h4>
                                                <i class="icon_profile "></i> Demandes d'adhésion
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-3">
                            <div class="panel panel-primary">
                                <div class="panel-heading text-center">Vos Contributions de ce mois</div>
                                <div class="panel-content">

                                        {!! Form::open(['url' => '#']) !!}
                                    @if((!($contributions == null)) && isset($contributions))
                                        <div class="form-group has-success">
                                            <label for="Contribution" class="control-label hidden">Vos Contributions de ce mois</label>
                                        <!--select ="Contribution" class="badge bg-info">{{--$contribution->motif--}}</select-->
                                            <br/>

                                            {!!Form::select('motif_contribution', $contributions,null,
                                            ['class' => 'form-control text-center'],
                                            ['placeholder' => 'Choisir un motif','style' => 'margin-top:5px'])!!}

                                            <br/>
                                            <input type="number" class="form-control text-center" id="amount_contribution" placeholder="{{$amount}}" disabled>

                                        </div>
                                        @else
                                        <div class="form-group ">
                                            <br/>
                                            <span class="badge bg-warning">Vous n'avez pas encore contribué pour ce mois</span>
                                            <!--input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email"-->
                                        </div>

                                        <br/>
                                        <button type="submit" class="btn btn-compose center-block " style="background-color: #ff2d55!important;">Contribuer pour ce mois</button>


                                    @endif
                                              {!! Form::close() !!}


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
                    'nbr_mem' => $nbr_mem_group[$user_group['group_ID']],
                    'id_group' => $user_group['group_ID']])

                @endforeach
            </div>

        </div>


    </section>

@endsection

@section('script')
    <script src="{{ asset('js/acceuil.js') }}"></script>

@endsection