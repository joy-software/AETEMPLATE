@extends('layouts.app')


@section('css')

    <link href="{{ asset('assets/css/group.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/displayAside.css') }}" rel="stylesheet">



@endsection

@section('title')
    Vos groupes dans PROMOT VOGT
@endsection

@section('sideOption')
    @include('layouts/asideOptionGenerated')

@endsection


@section('content')
    @if(\Illuminate\Support\Facades\Session::has('success'))
        <div class="alert alert-success"> {{ Session::get('success') }} </div>
    @endif

    <section class="wrapper">

        <div  id = "inline-aside" class="row" style="display: none">
            <div class="col-lg-12">
                <!--breadcrumbs start -->


                <ul class="breadcrumb" id="menu_group">
                    <li><a href="/group/search_group" ><i class="icon_search"></i> Rechercher un groupe </a></li>
                    <li><a href="/group/create_group" ><i class="icon_pencil-edit"></i> Créer un groupe </a></li>

                    @if($list_group != null)
                        @foreach($list_group as $list_group_el)

                            <li><a href="/group/view_group/{{$list_group_el['id']}}" id={{$list_group_el['id']}}><i class="icon_house_alt"></i> {{$list_group_el['name']}}</a></li>
                        @endforeach
                    @endif
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div >

        <div class="row state-overview">
            <div class="col-lg-12">
                <!--user profile info start-->
                <section class="panel"  style="background-color: #eeeeee!important;">
                            <div class="profile-widget profile-widget-info " >
                                <div class="panel-body" >
                                    <div class="col-lg-1 col-sm-1 profile-widget-name">

                                        <h4>{{$avatar->surname}}</h4>
                                        <div class="follow-ava">
                                            <img src="{{ url('cache/logo/'.$avatar->photo) }}" alt="photo" style="background-color: white">
                                        </div>
                                        @role('admin_1')
                                        <h6>Administrateur</h6>
                                        @endrole()
                                    </div>
                                    <div class="col-lg-8 col-sm-8 follow-info">
                                        <p style="text-overflow: clip">{{$avatar->description}}</p>

                                        <h6>
                                            <span><i class="icon_clock_alt"></i>{{$date->toTimeString() }}</span>
                                            <span><i class="icon_calendar"></i>{{$date->toDateString()}}</span>
                                            <span><i class="icon_pin_alt"></i>{{$avatar->country}}</span>
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
    <script src="{{ asset('assets/js/acceuil.js') }}"></script>

@endsection