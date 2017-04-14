
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
        <h1>Liste des membres du groupe d'id = {{$id}}</h1>

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
                    <tr>
                        <td>
                                    <span class="profile-ava">
                                        <img alt="" class="simple" src="img/avatar1_small.jpg">
                                    </span>
                        </td>
                        <td>
                            <p class="profile-name">John Doe</p>
                            <p class="profile-occupation">UX Designer</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                                    <span class="profile-ava">
                                        <img alt="" class="simple" src="img/avatar-mini.jpg">
                                    </span>
                        </td>
                        <td>
                            <p class="profile-name">Rena Rios</p>
                            <p class="profile-occupation">UX Designer</p>
                        </td>

                    </tr>
                    <tr>
                        <td>
                                    <span class="profile-ava">
                                        <img alt="" class="simple" src="img/avatar-mini2.jpg">
                                    </span>
                        </td>
                        <td>
                            <p class="profile-name">Robin Mathis</p>
                            <p class="profile-occupation">UX Designer</p>
                        </td>

                    </tr>

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