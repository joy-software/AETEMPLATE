
@extends('layouts/app')

@section('css')

    <link href="{{ asset('assets/css/group.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/table.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/displayAside.css') }}" rel="stylesheet">


@endsection

@section('title')
    Rechercher des groupes
@endsection

@section('sideOption')
    @include('layouts/asideOptionGenerated')
@endsection


@section('content')

    <section class="wrapper">

        <div  id = "inline-aside" style="display: none" class="row">
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

        <div class="row">
            <div class="col-md-12">
                <section  id=""  class="panel">
                    <header class="panel-heading">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-6 col-md-offset-3" style="text-align: center">
                                <h3>Rechercher un groupe</h3>
                            </div>
                        </div>

                    </header>

                    <style>
                        #table_resultats_filter {
                            display : none;
                        }

                        table.dataTable thead .sorting:after {
                            display: none !important;
                        }
                    </style>

                    <div id="result_Search" class="panel-body" >

                        <div class="row col-md-offset-1 col-md-10 col-md-offset-1" >

                            <div class="col-md-offset-2 col-md-10 ">
                                <table  style="width: 90%;">
                                    <tbody>
                                    <tr>
                                        <td id="filter_global">
                                            <input type="text" class="global_filter form-control" placeholder="Taper un mot clé, nom d'un groupe, etc ..." id="global_filter">

                                        </td>
                                    </tr>

                                    @if(Session::has('message'))
                                        <tr>
                                            <td><br></td>
                                        </tr>
                                        <tr>
                                            <td>

                                                <div class="alert alert-success fade in">
                                                    <button data-dismiss="alert" class="close close-sm" type="button">
                                                        <i class="icon-remove"></i>
                                                    </button>
                                                    <strong>{{ Session::get('message') }}</strong>
                                                </div>
                                            </td>
                                        </tr>
                                     @endif

                                    </tbody>
                                </table>
                            </div>
                            <br>
                        </div>



                        <!--table id="table_resultats" class="table table-bordered table-responsive table-striped dataTable display"-->

                        <table id="table_resultats" class="table table-striped table-advance table-responsive "  style="width:100%; margin: auto !important;">
                            <thead>
                            <tr>
                                <th>
                                    Logo
                                </th>

                                <th><i class="icon_profile"></i> Nom </th>

                                <th>
                                    <i class="icon_calendar"></i> Description
                                </th>

                                <th><i class="icon_pin_alt"></i> Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($all_group as $all_group_el)
                                <tr>
                                    <td><img src="{{url('cache/logo/'.$all_group_el->logo)}}" alt="Photo du groupe"></td>
                                    <td>{{ $all_group_el->name}}</td>
                                    <td>{{ $all_group_el->description}}</td>
                                    <td>
                                        <?php $role_admin= "admin_".$all_group_el->id; $_is_admin = false;?>
                                        @role($role_admin)
                                            <?php $_is_admin = true; ?>
                                        <a class="btn btn-danger disabled" href="{{ route('del_group', $all_group_el->id) }}">Supprimer</a> |
                                        <a class="btn btn-success disabled" href="{{ route('edit_group', $all_group_el->id) }}">Editer</a>
                                        @endrole
                                        <?php

                                         if($_is_admin == false)
                                             {
                                            if(array_key_exists(''.$all_group_el->id.'', $statut_group)){
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
                                            else {
                                                //Alors il n'est pas du groupe.
                                                ?>
                                            <a class="btn btn-primary disabled" href="{{ route('invitation_group', $all_group_el->id) }}">Adhérer à ce groupe</a>
                                            <?php }
                                             }

                                                ?>

                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>


    </section>

@endsection

@section('script')

    <script src="{{ asset('assets/js/table.js') }}"></script>
    <script src="{{ asset('assets/js/group.js') }}"></script>

@endsection