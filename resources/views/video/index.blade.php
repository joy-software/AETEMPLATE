
@extends('layouts/app')

@section('css')

    <link href="{{ asset('css/group.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/displayAside.css') }}" rel="stylesheet">
    <link href="{{ asset('css/avatar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.foundation.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/listViewVideo.css') }}" rel="stylesheet">

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
                    <li><a href="/group/view_group/1"><i class="icon_house_alt"></i> Assemblée générale </a></li>
                    <li><a href="/group/ads_group/1">Annonces </a></li>
                    <li><a href="/group/event_group/1">Evènements </a></li>
                    <li><a href="/group/meeting_group/1">Réunions </a></li>
                    <li><a href="{{ route('video_list') }}"><strong>Vidéos</strong> </a></li>
                    <li><a href="/group/ballot_group/1">Scrutin</a></li>
                    <li><a href="/group/member_group/1">Membres </a></li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>

        <section  id="section-annuaire"  class="panel">
            <header class="panel-heading">
                <div class="row">
                    <div class="col-md-offset-3 col-md-6 col-md-offset-3 center">
                        <label>Liste des vidéos</label>

                        <br>
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

            <?php
                $status = $videos['status'];
                $videos = $videos['content'];

            ?>

            @if ($status == 'success')

                <!-- Modal -->
                    <div class="modal fade" id="ConfirmAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <button id="button" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                            <div class="content-player">
                                <iframe id="player" type="text/html" width="640" height="360"
                                        src="http://www.youtube.com/embed/rY_OAVLVC_E?enablejsapi=1"
                                        frameborder="0"></iframe>
                            </div>


                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

                <div id="result_Search" class="panel-body" id="result_ann" >

                    <div class="row col-md-offset-1 col-md-10 col-md-offset-1" >

                        <div class="col-md-3">
                            <table  style="width: 90%; ">
                                <thead>
                                <tr><td><label>Recherche globale </label></td></tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td id="filter_global">
                                        <input type="text" class="global_filter form-control" id="global_filter">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-3">
                            <table style="width: 90%; ">
                                <thead>
                                <tr>
                                    <td><label for="">Par nom</label> </td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr id="filter_col2" data-column="1">
                                    <td >
                                        <input  type="text" class="column_filter form-control" id="col1_filter">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-3">

                            <table style="width: 90%;">
                                <thead>
                                <tr><td><label for="">Par déscription</label> </td></tr>
                                </thead>
                                <tbody>
                                <tr id="filter_col4" data-column="3">
                                    <td><input type="text" class="column_filter form-control" id="col3_filter"></td>
                                </tr>
                                </tbody>
                            </table>

                        </div>

                        <div class="col-md-3">
                            <table  style="width: 90%; ">
                                <thead>
                                <tr>
                                    <td><label for="">Par Date</label> </td>
                                </tr>
                                </thead>

                                <tbody>

                                <tr id="filter_col5" data-column="4">
                                    <td>
                                        <input type="text" class="column_filter form-control" id="col4_filter">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <br>
                        </div>

                    </div>


                    <table id="table_resultats" class="table table-striped table-advance table-hover table-responsive "  style="width:90%; margin: auto !important;">

                        <thead>
                        <tr>
                            <th>
                                Vidéos
                            </th>

                            <th><i class="icon_calendar"></i> Noms</th>

                            <th>
                                <i class="icon_profile"></i>Description
                            </th>

                            <th>Date
                            </th>
                        </tr>
                        </thead>


                        <tbody>

                        @foreach($videos as $video)
                            <tr id="{{$video['id']}}" class="clickable">
                                <td><img alt="miniature" src="{{ $video['thumbnails'] }}"></td>
                                <td>{{ $video['title'] }}</td>
                                <td>{{ $video['description'] }}</td>
                                <td>{{ $video['date'] }}</td>

                            </tr>
                        @endforeach

                        </tbody>

                    </table>

                </div>

            @elseif ($status == 'error')

                <p class="alert-block text-danger">Une erreur connue est intervenue lors du processus</p>

            @elseif ($status == 'unknown')

                <p class="alert-block text-danger">Une erreur inconnue est intervenue lors du processus</p>

            @endif



        </section>

    </section>

@endsection

@section('script')
    <script>

            urlViewVideo = "<?php echo route('video_view', 5) ?>";
            csrfToken = '<?php echo csrf_token() ?>';


    </script>
    <script src="{{ asset('js/group.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/listViewVideo.js') }}"></script>

@endsection