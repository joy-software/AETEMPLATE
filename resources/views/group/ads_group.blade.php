
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

        <div class="row">
            <section class="panel col-lg-offset-2 col-lg-8" style="background-color: #3097D1">
                <a class="list-group-item active">Annonces du groupe {{ $group->name }}</a>
            </section>
        </div>

        <div class="row" style="text-align: center;">
            @if($ads != null ) {{ $ads->links() }} @endif
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

        <?php } ?>
        <div class="row" style="text-align: center;">
            @if($ads != null ) {{ $ads->links() }} @endif
        </div>


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
    <script src="{{ asset('js/group.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>

@endsection