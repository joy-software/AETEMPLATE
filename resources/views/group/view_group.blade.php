
@extends('layouts/app')

@section('css')

    <link href="{{ asset('css/group.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/displayAside.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.foundation.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/avatar.css') }}" rel="stylesheet">

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
                    <li><a href="/group/ballot_group/{{$group->id}}">Scrutin</a></li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>


        <div class="row">
            <section class="panel col-lg-offset-1 col-lg-10" >
            <div class="panel-body progress-panel">
                <div class="row">
                    <div class="col-lg-8 task-progress pull-left">
                        <h1>Demande d'adhésion à {{ $group->name }}</h1>
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
            <div class="col-lg-offset-2 col-lg-8">
                <div class="list-group">
                    <a class="btn btn-primary list-group-item active" id="show_create_ad" > Je veux créer une annonce </a>
                </div>
            </div>
        </div>
        <div class="row" id="div_create_ad" >
            <section class="panel col-lg-offset-1 col-lg-10">
                {!! Form::open(array('route' => 'post_ads','files'=>true, 'id'=> 'create_ad', 'method'=>'post')) !!}
                <div class="row">
                    <div class="col-lg-8">
                        <section class="panel" >
                            <header class="panel-heading">
                                Créer une annonce / évènement
                            </header>
                            <div class="panel-body" style="text-align: center;">

                                <div class="alert alert-block alert-danger fade in" id="message">

                                </div>

                                <input type="text" class="hidden" value="{{ $group->id }}" name="id_group">
                                <textarea cols="10" rows="10" name="description" id="description_create_ad" class="form-control"></textarea>
                            </div>

                        </section>
                    </div>
                    <div class="col-lg-4 well">
                        <p>
                            Joindre des fichiers a l'annonce <br>
                        <div class="row" id="span_file1">
                                <div class="col-lg-9">
                                    <input type="file" name="file1" id="file1" class="form-control btn btn-primary">
                                </div>
                                <div class="col-lg-3">
                                    <a id="del_file1" class="btn btn-danger"><i class="icon_close_alt2"></i></a>
                                </div>
                        </div><br>
                        <div class="row" id="span_file2">
                            <div class="col-lg-9">
                                <input type="file" name="file2" id="file2" class="form-control btn btn-primary">
                            </div>
                            <div class="col-lg-3">
                                <a id="del_file2" class="btn btn-danger"><i class="icon_close_alt2"></i></a>
                            </div>
                        </div><br>
                        <div class="row" id="span_file3">
                            <div class="col-lg-9">
                                <input type="file" name="file3" id="file3" class="form-control btn btn-primary">
                            </div>
                            <div class="col-lg-3">
                                <a id="del_file3" class="btn btn-danger"><i class="icon_close_alt2"></i></a>
                            </div>
                        </div><br>

                        <!--div id="span_file2"><input type="file" name="file2" id="file2"  class="form-control btn btn-primary"> <br> </div>
                            <div-- id="span_file3"><input type="file" name="file3" id="file3"  class="form-control btn btn-primary"> </div-->
                        </p>

                        <p>
                        <label class="checkbox checkbox-inline">
                            <input type="checkbox" id="checkbox-even" name="checkbox_even" value="option1"> Publier comme un évènement
                        </label>
                        </p>
                        <p id="p_date_even" style="margin-left: -20px;">
                        <label class="checkbox checkbox-inline">
                            Cet évènement sera valide jusqu'en <input name="expiration_date" type="date" id="input_date" class="form-control">
                        </label>
                        </p>

                    </div>
                    <br>
                </div>
                <div class="row" style="text-align: center;">
                    <div class="col-lg-offset-2 col-lg-2">
                        <p>
                            <button class="btn btn-primary" id="btn-create-ads" style="width: 250px;">Créer l'annonce</button>
                        </p>
                    </div>
                </div>
                {!! Form::close() !!}
            </section>
        </div>



        <!--div>
          Partie des évènements !!!
      </div-->

    <div class="row col-lg-offset-1 col-lg-10" style="text-align: center;">
        <ul class="breadcrumb" id="menu_group">
            <li><a><h4>Evènement</h4></a></li>
        </ul>
    </div>

        <?php

        if($events != null){
        $compteur =0;
        foreach ($events as $event) {
        $compteur++;

        ?>



        <div class="row" id="evenement{{ $compteur }}">
            <section class="panel col-lg-offset-2 col-lg-8">
                <div class="panel-body progress-panel">
                    <div class="row">
                        <div class="col-lg-8 task-progress pull-left">
                            <span class="pull-left">
                                        <img style="width : 50px; height: auto;" class="simple" src="/{{ $tab_users[''. $event->id .'']['photo'] }}">
                                {{ $tab_users[''.$event->id .'']['name'] }} , {{ $tab_users[''. $event->id .'']['surname'] }}
                                </span>
                        </div>
                        <div class="col-lg-4">
                            <span class="badge bg-success"><?php $std = $event->created_at; echo $std->toRfc850String(); ?></span> <br><br>
                            <span class="badge bg-warning"><?php $std2 = $event->expiration_date; echo $std2; ?></span>
                        </div>
                    </div>
                </div>

                <table class="table table-hover personal-task">
                    <tbody>
                    <tr>
                        <td style="text-align: justify;">
                            {{ $event->description }}
                        </td>
                    </tr>
                    <tr>
                        <td class="pull-left">
                            <?php
                            if( ! empty($tab_events_final[''.$event->id.''])){

                            $nb = substr_count($tab_events_final[''.$event->id.''],"|");
                            switch ($nb){
                                case 0 :
                                    $lien1 = $tab_events_final[''.$event->id.'']; $lien2 = $lien3= null;
                                    break;
                                case 1 :
                                    list($lien1, $lien2) = explode("|", $tab_events_final[''.$event->id.'']);
                                    $lien3 = null;
                                    break;
                                case 2 :
                                    list($lien1, $lien2, $lien3) = explode("|", $tab_events_final[''.$event->id.'']);
                                    break;
                                default :
                                    break;
                            }

                            if($lien1 != null){
                            ?>
                            <a style="margin-right: 50px;" target="_blank" href="/{{ $lien1 }}" > <i class="icon_download"></i>  <?php $name = explode("/", $lien1); echo $name[count($name)-1];?> </a>
                            <?php
                            if($lien2 != null){
                            ?>
                            <a style="margin-right: 50px" target="_blank" href="/{{ $lien2 }}" target="_blank"><i class="icon_download"></i>  <?php $name = explode("/", $lien2); echo $name[count($name)-1];?> </a>
                            <?php
                            if($lien3 != null){
                            ?>
                            <a style="margin-right: 50px" target="_blank" href="/{{ $lien3 }}" target="_blank"> <i class="icon_download"></i> <?php $name = explode("/", $lien3); echo $name[count($name)-1];?></a>

                            <?php
                                        }
                                    }
                                }
                            }
                            else{  ?> <span class="badge bg-warning">Aucun fichier pour cet évènement </span>
                            <?php
                            }
                            }

                            ?>
                        </td>
                    </tr>
                    </tbody>
                </table>

            </section>
        </div>
        <?php
        }
        else {
        ?>
        <div class="row" id="evenement0" >
            <section class="panel col-lg-offset-2 col-lg-8" style="background-color: #3097D1">
                        <a class="list-group-item active">Ce groupe n'a aucun evènement</a>
            </section>
        </div>

        <?php    }

        ?>

        <!--div>
            Partie des annoncess !!!!!
        </div-->

        <div class="row col-lg-offset-1 col-lg-10" style="text-align: center;">
            <ul class="breadcrumb" id="menu_group">
                <li><a><h4>Annonce</h4></a></li>
            </ul>
        </div>

    <?php

            if($ads != null){
        $compteur =0;
        foreach ($ads as $ad) {
            $compteur++;


        ?>



        <div class="row" id="annonce{{ $compteur }}">
            <section class="panel col-lg-offset-2 col-lg-8">
                <div class="panel-body progress-panel">
                    <div class="row">
                        <div class="col-lg-8 task-progress pull-left">
                            <span class="pull-left">
                                        <img style="width : 50px; height: auto;" class="simple" src="/{{ $tab_users[''. $ad->id .'']['photo'] }}">
                                          {{ $tab_users[''.$ad->id .'']['name'] }} , {{ $tab_users[''. $ad->id .'']['surname'] }}
                                </span>

                            <?php ?>

                        </div>
                        <div class="col-lg-4">
                            <span class="badge bg-success"><?php $std = $ad->created_at; echo $std->toRfc850String(); ?></span>
                        </div>
                    </div>
                </div>

                <table class="table table-hover personal-task">
                    <tbody>
                    <tr>
                        <td style="text-align: justify;">
                            {{ $ad->description }}
                        </td>
                    </tr>
                    <tr>
                        <td class="pull-left">
                            <?php
                                if( ! empty($tab_ads_final[''.$ad->id.''])){

                                    $nb = substr_count($tab_ads_final[''.$ad->id.''],"|");
                                    switch ($nb){
                                        case 0 :
                                            $lien1 = $tab_ads_final[''.$ad->id.'']; $lien2 = $lien3= null;
                                            break;
                                        case 1 :
                                            list($lien1, $lien2) = explode("|", $tab_ads_final[''.$ad->id.'']);
                                            $lien3 = null;
                                            break;
                                        case 2 :
                                            list($lien1, $lien2, $lien3) = explode("|", $tab_ads_final[''.$ad->id.'']);
                                            break;
                                        default :
                                            break;
                                    }

                                    if($lien1 != null){
                                        ?>
                                        <a style="margin-right: 50px" href="/{{ $lien1 }}" target="_blank"><i class="icon_download"></i> <?php $name = explode("/", $lien1); echo $name[count($name)-1];?></a>
                                    <?php
                                        if($lien2 != null){
                                            ?>
                                            <a style="margin-right: 50px" href="/{{ $lien2 }}" target="_blank"><i class="icon_download"></i> <?php $name = explode("/", $lien2); echo $name[count($name)-1];?></a>
                                            <?php
                                            if($lien3 != null){
                                            ?>
                                            <a style="margin-right: 50px" href="/{{ $lien3 }}" target="_blank"><i class="icon_download"></i> <?php $name = explode("/", $lien3); echo $name[count($name)-1];?></a>

                                            <?php
                                              }
                                            }
                                        }
                                    }
                                    else{  ?> <span class="badge bg-warning">Aucun fichier pour cette annonce</span>
                                        <?php
                                   } ?>

                        </td>
                    </tr>
                    </tbody>
                </table>

            </section>
        </div>

        <?php }

        ?>
        <?php
            }
            else {
                ?>
        <div class="row" id="annonce0">
            <section class="panel col-lg-offset-2 col-lg-8" style="background-color: #3097D1">
                <a class="list-group-item active">Ce groupe n'a aucune Annonce</a>
            </section>
        </div>

        <?php    } ?>



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


    _token = $('input[name=_token]').val();
    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });



</script>

    <script src="{{ asset('js/group.js') }}"></script>

@endsection