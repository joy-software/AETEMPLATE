
@extends('layouts/app')

@section('css')

    <link href="{{ asset('assets/css/group.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/displayAside.css') }}" rel="stylesheet">


@endsection

@section('title')
    Membre du groupe {{ $group->name }}
@endsection

@section('sideOption')
    @include('layouts/asideOptionGenerated')

@endsection




@section('content')


    <section class="wrapper">

        <div class="row">
            <div class="col-lg-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb" id="menu_group">
                    <li><a href="/group/view_group/{{ $group->id }}" ><i class="icon_house_alt"></i> {{ $group->name }} </a></li>
                    <li><a href="/group/ads_group/{{ $group->id }}">Annonces </a></li>
                    @if($group->id == 1)
                    <li><a href="/group/event_group/{{ $group->id }}">Reunions </a></li>

                        <li><a href="{{ route('video_list') }}">Vidéos </a></li>
                    @endif
                    <li><a href="/group/member_group/{{ $group->id }}"  style="color: #ff2d55!important;">Membres </a></li>

                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>

        <style>
            .personal-task > tbody > tr > td:last-child {
                text-align: left;
            }
        </style>
        <div class="row">
             <div class="col-lg-12">
            <!--project team start-->
            <section class="panel">
                <div class="panel-body project-team">
                    <div class="row">
                        <div class="col-lg-7 task-progress pull-left">
                            <small><h1> Liste des membres du groupe {{ $name_group }}</h1></small>
                        </div>
                        <div class="col-lg-5">
                            <span class="profile-ava pull-right">
                            <a href="{{route('view_group',$id_group)}}" class="btn btn-primary disabled">Aller à l'accueil du groupe</a>
                            </span>

                        </div>
                    </div>


                </div>
                <table class="table table-hover personal-task">
                    <tbody>

                    @foreach($tab_user_membre as $member)

                        <tr>
                            <td>
                                <span class="profile-ava">

                                     <img alt="photo" class="simple"

                                        @if((!($member->photo == null) && isset($member->photo)))
                                            src="{{ url('cache/logo/'.$member->photo) }}"

                                        @else

                                            @if ($member->sex == 'M')

                                                src="{{url("cache/logo/"."users/default_gent_avatar.png")}}"
                                            @else

                                                src="{{url("cache/logo/"."users/default_lady_avatar.png")}}"
                                        @endif
                                                @endif

                                     style="width: 50px; height: auto;" >
                                </span>
                            </td>
                            <td>
                                <p class="profile-name">{{$member->name}}, {{$member->surname}}</p>
                                <p class="profile-occupation">{{$member->profession}}</p>
                            </td>
                            <!--td>
                                <p>
                                    Promotion {{--$user->promotion--}}
                                </p>
                            </td-->
                            <td>
                                <p>
                                     Email : <label>  {{$member->email}} </label>,<br> Tel : <label> {{$member->phone}} </label>
                                </p>
                            </td>
                            <td>
                                <p style="text-align: justify;">
                                    {{$member->description}}
                                </p>
                            </td>

                            <td>

                                <?php $role_admin= "admin_".$id_group; $_is_admin = false;?>
                                @if(Auth::id() == $member->id)
                                @role($role_admin)
                                <?php $_is_admin = true; ?>
                                    <span class="badge bg-success">Vous êtes administrateur</span>
                                @endrole
                                    @endif

                            </td>

                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </section>
            <!--Project Team end-->
        </div>
        </div>

    </section>

@endsection

@section('script')
    <script src="{{ asset('assets/js/group.js') }}"></script>

@endsection