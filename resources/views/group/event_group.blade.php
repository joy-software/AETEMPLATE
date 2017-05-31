
@extends('layouts/app')

@section('css')

    <link href="{{ asset('assets/css/group.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/displayAside.css') }}" rel="stylesheet">

@endsection

@section('title')
    Reunion du groupe {{ $group->name }}
@endsection

@section('sideOption')
    @include('layouts/asideOptionGenerated')

@endsection




@section('content')


    <section class="wrapper">

        <div class="row">
            <div class="modal fade" id="live-meeting" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <button id="button" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <div class="content-player" style="height: 600px">
                        <div id="player"></div>
                    </div>

                </div>
            </div>
        </div>

        <div  id = "inline-aside" style="display: none" class="row">
            <div class="col-lg-12">

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


        <div class="row">
            <div class="col-lg-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb" id="menu_group">
                    <li><a href="/group/view_group/{{ $group->id }}"><i class="icon_house_alt"></i> {{ $group->name }} </a></li>
                    <li><a href="/group/ads_group/{{ $group->id }}">Annonces </a></li>
                    @if($group->id == 1)
                    <li><a href="/group/event_group/{{ $group->id }}"  style="color: #ff2d55!important;">Reunions </a></li>

                        <li><a href="{{ route('video_list') }}">Vidéos </a></li>
                    @endif
                    <li><a href="/group/member_group/{{ $group->id }}">Membres </a></li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>

        <div class="row">
            <section class="panel col-lg-offset-2 col-lg-8" style="background-color: #3097D1">
                <a class="list-group-item active">Reunions du groupe {{ $group->name }}</a>
            </section>
        </div>

        <div class="row" style="text-align: center;">
            @if($events != null ) {{ $events->links() }} @endif
        </div>
        <?php
        if($events != null){
        $compteur =0;
        foreach ($events as $event) {
        $compteur++;
        ?>

        <div class="row" id="evenement{{ $compteur }}">
            <section class="panel col-lg-offset-2 col-lg-8">
                <div class="panel panel-primary progress-panel">
                    <div class="row">
                        <div class="col-lg-6 task-progress pull-left">
                            <span class="pull-left">
                                <img style="width : 50px; height: auto;" class="simple" src="{{ url('cache/logo/'.$tab_users[''. $event->id .'']['photo'])}}">
                                {{ $tab_users[''.$event->id .'']['name'] }} , {{ $tab_users[''. $event->id .'']['surname'] }}
                                </span>
                        </div>
                        <div class="col-lg-6">
                            Reunion prévue pour le <?php $std = $event->expiration_date; echo $std; ?>
                        </div>
                    </div>
                </div>

                <table class="table table-hover personal-task">
                    <tbody>
                    <tr>
                        <td style="text-align: justify;">
                            {{ $event->description }} <br>
                            <?php if($event->broadcast != null) {
                                echo "<button id='btnLive' class='btn btn-primary disabled' data-toggle='modal' data-target='#live-meeting'><span id='" . $event->broadcast . "' > Voir la reunion</span></button>";
                            }?>
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
                            <a style="margin-right: 50px;" target="_blank" href="{{ url('cache/download/'.$lien1)}}" > <i class="icon_download"></i> <?php $name = explode("/", $lien1); echo $name[count($name)-1];?> </a>
                            <?php
                            if($lien2 != null){
                            ?>
                            <a style="margin-right: 50px" target="_blank" href="{{ url('cache/download/'.$lien2) }}" target="_blank"><i class="icon_download"></i>  <?php $name = explode("/", $lien2); echo $name[count($name)-1];?> </a>
                            <?php
                            if($lien3 != null){
                            ?>
                            <a style="margin-right: 50px" target="_blank" href="{{ url('cache/download/'.$lien3) }}" target="_blank"><i class="icon_download"></i> <?php $name = explode("/", $lien3); echo $name[count($name)-1];?></a>

                            <?php
                            }
                            }
                            }
                            }
                            else{  ?> <span class="badge bg-warning">Aucun fichier pour cette reunion </span>
                            <?php
                            }

                            ?>
                        </td>
                    </tr>
                    </tbody>
                </table>

            </section>
        </div>

        <?php
        } ?>

        <div class="row" style="text-align: center;">
            @if($events != null ) {{ $events->links() }} @endif
        </div>

        <?php
        }
        else {
        ?>
        <div class="row" id="evenement0" >
            <section class="panel col-lg-offset-2 col-lg-8" style="background-color: #3097D1">
                <a class="list-group-item active">Ce groupe n'a aucun aucune reunion</a>
            </section>
        </div>

        <?php    }

        ?>


    </section>

@endsection

@section('script')
    <script src="{{ asset('assets/js/group.js') }}"></script>
    <script src="{{ asset('assets/js/view_meeting.js') }}" ></script>

@endsection