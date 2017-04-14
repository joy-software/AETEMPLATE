
@extends('layouts/app')

@section('css')

    <link href="{{ asset('css/group.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/displayAside.css') }}" rel="stylesheet">

    <link href="{{ asset('css/dataTables.foundation.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">

@endsection

@section('sideOption')
    @include('layouts/asideOptionGenerated')

@endsection




@section('content')


    <section class="wrapper">

        <style>
            .personal-task > tbody > tr > td:last-child {
                text-align: left;
            }
        </style>
        <div class="col-lg-4">
            <!--project team start-->
            <section class="panel">
                <div class="panel-body project-team">
                    <div class="task-progress">
                        <h1>Project Team</h1>
                    </div>
                </div>
                <table class="table table-hover personal-task">
                    <tbody>

                    @foreach($tab_user_membre as $user)

                    <tr>
                        <td>
                            <span class="profile-ava">
                                <img alt="" class="simple" src="/{{$user->logo}}">
                            </span>
                        </td>
                        <td>
                            <p class="profile-name">{{$user->name}}, {$user->surname}}</p>
                            <p class="profile-occupation">{{$user->profession}}</p>
                        </td>
                        <td>
                            <p>
                                {{$user->description}}
                            </p>
                        </td>

                        <td>
                            <?php $role_admin= "admin_".$id_group; $_is_admin = false;?>
                            @role($role_admin)
                            <?php $_is_admin = true; ?>
                                <span class="badge bg-success">Administrateur du groupe</span>
                            @endrole
                            <?php

                            if($_is_admin == false)
                            {

                            if($statut_group[''.$all_group_el->id.''] == 'actif'){
                            ?>
                            <span class="badge bg-success">Vous êtes déjà membre de ce groupe</span>
                            <?php }
                            else if($statut_group[''.$all_group_el->id.''] == 'attente') {
                            ?>
                            <span class="badge bg-info">En attente de validation de votre adhésion</span>
                            <?php   }
                            else if($statut_group[''.$all_group_el->id.''] == 'suspendu'){
                            ?>
                            <span class="badge bg-important">Vous avez été suspendu de ce groupe</span>
                            <?php }

                            }

                            ?>



                        </td>

                    </tr>

                    @endforeach
                    </tbody>
                </table>
            </section>
            <!--Project Team end-->
        </div>


    </section>

@endsection

@section('script')
    <script src="{{ asset('js/group.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>

@endsection