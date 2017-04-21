
@extends('layouts/app')

@section('css')

    <link href="{{ asset('css/group.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/displayAside.css') }}" rel="stylesheet">
    <link href="{{ asset('css/avatar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.foundation.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">

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
                    <li><a href="/group/view_group/{{ $group->id }}"><i class="icon_house_alt"></i> {{ $group->name }} </a></li>
                    <li><a href="/group/member_group/{{ $group->id }}">Membres </a></li>
                    <li><a href="/group/ads_group/{{ $group->id }}">Annonces </a></li>
                    <li><a href="/group/event_group/{{ $group->id }}">Evènements </a></li>
                    <li><a href="/group/ballot_group/{{$group->id }}">Scrutin</a></li>
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
                            <a href="{{route('view_group',$id_group)}}" class="btn btn-primary">Aller à l'accueil du groupe</a>
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

                                <?php
                                $chemin_photo = "users/user.png";
                                if(! ($member->photo == null || isset($member->photo))){
                                    $chemin_photo = $user->photo;
                                }
                                ?>
                                <img alt="" class="simple" src="/<?php echo $chemin_photo?>" style="width: 50px; height: auto;">
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

                            @role($role_admin)
                            <?php $_is_admin = true; ?>
                                <span class="badge bg-success">Vous êtes administrateur</span>
                            @endrole

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
    <script src="{{ asset('js/group.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>

@endsection