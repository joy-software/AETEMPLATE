
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
        <div class="row">
            <div class="col-lg-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                    <li><a href="{{ route('accueil') }}"><i class="icon_house_alt"></i> Home</a></li>
                    <li><a href="/group/"> Groupes </a></li>
                    <li class="active">{{$group->name}}</li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>
        <div class="row">
            <section class="panel col-lg-offset-1 col-lg-10" >
            <div class="panel-body progress-panel">
                <div class="row">
                    <div class="col-lg-8 task-progress pull-left">
                        <h1>Demande d'adhésion</h1>
                    </div>
                    <div class="col-lg-4">
                        <?php if($users != null){
                            ?>
                        <button  class="btn btn-primary pull-right" type="button"  id="show_demande">Afficher les demandes</button>
                        <button id="hide_demande" class="btn btn-primary pull-right hidden" >Cacher les demandes</button>
                        <br>
                        <?php
                            } else {
                            ?>
                            <span class="badge bg-success pull-right">Aucune demande d'adhésion</span>
                            <?php } ?>

                    </div>

                </div>
                <br>
                <div class="row" id="message_adhesion">

                </div>
            </div>
            <br>
            <section id="section_demande"  style="display: none;" class="well" >
                <table id="tab_demande" class="table table-hover personal-task table-responsive ">
                <tbody>

                <?php

                if($users != null){

                foreach($users as $user){
                    ?>
                <tr id="tr-user-{{ $user['id'] }}">
                    <td id="td-image-{{ $user['id'] }}" style="width: 15%;">
                        <span class="profile-ava">
                           <img alt="" class="simple" style="width : 100%; height : auto;" src="/{{ $user['photo'] }}">
                        </span>
                    </td>

                    <td id="td-name-{{ $user['id'] }}">{{ $user['name'] }}, {{ $user['surname'] }}.<br> Promotion <span class="badge bg-primary">{{ $user['promotion'] }}</span> </td>

                    <td style="text-align: justify;">
                        <p> Email : <label> {{ $user['email'] }}</label><br>
                            Tel : <label>{{ $user['phone'] }}</label>
                        </p>
                        <p id="td-desc-{{ $user['id'] }}">
                            {{ $user['description'] }} <br>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.

                        </p>
                    </td>
                    <td style="width: 25%">
                        <button style="width:80%;" id="btn-accept-{{ $user['id'] }}"  data-toggle="modal" data-target="#ConfirmAction" class="btn btn-primary send-btn">Accepter</button>
                        <br><br>
                        <?php $role_admin= "admin_".$group->id; ?>
                        @role($role_admin)
                        <button style="width:80%;"  id="btn-refuse-{{ $user['id'] }}" class="btn btn-danger refuse-btn">Refuser</button>
                        @endrole
                    </td>

                </tr>
                <?php
                        }
                       } ?>

                </tbody>
            </table>

                <!-- Modal -->
                <div class="modal fade" id="ConfirmAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                            </div>
                            <div class="modal-body" style="background: white;">
                                Exemple de modal
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

            </section>


        </section>
        </div>
        <div class="row">
            <section class="panel col-lg-offset-1 col-lg-10">
                <div class="row">
                    <div class="col-lg-8">
                        <section class="panel">
                            <header class="panel-heading">
                                Créer une publication
                            </header>
                            <div class="panel-body">
                                <textarea cols="10"  rows="8" class="form-control" value="Exprimez-vous">
                                        Exprimez-vous
                                </textarea>
                            </div>
                        </section>
                    </div>
                    <div class="col-lg-4">
                        <label class="checkbox inline">
                            <input type="checkbox" id="" value="option1"> Publier comme un évènement
                        </label>

                    </div>

                </div>

            </section>
        </div>






    </section>

@endsection



@section('script')

    <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/collapse.js') }}"></script>
<script>

    var group = new Object();
    group.id = '<?php echo $group->id ?>';
    group.name = '<?php echo $group->name ?>';

    group.description = '{{ $group->description }}';
    group.logo = '{{ $group->logo }}';
    group.user_ID = '{{ $group->user_ID }}';



    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });

    var _token = $('input[name=_token]').val();

</script>

    <script src="{{ asset('js/group.js') }}"></script>

@endsection