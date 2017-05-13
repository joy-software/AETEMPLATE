
@extends('layouts/app')

@section('css')

    <link href="{{ asset('assets/css/group.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/table.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/displayAside.css') }}" rel="stylesheet">
    <link href="{{ asset('css/listViewVideo.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/login.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/register.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/upload.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/uploadVideo.css') }}" rel="stylesheet">


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
                    <li><a href="/group/meeting_group/1">Réunions </a></li>
                    <li><a href="{{ route('video_list') }}"><span style="color: red">Vidéos</span> </a></li>
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

                <div class="modal fade" id="ConfirmAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <button id="button" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <div class="content-player">
                            <div id="player"></div>
                        </div>

                    </div>
                </div>

                <div class="modal fade" id="addVideoAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">

                        <div class="content-form">

                            <form class="form-validate form-horizontal " enctype="multipart/form-data" id="upload-form" method="post" action="{{ route('post_video_upload') }}">
                                {{ csrf_field() }}
                                <div class="form-group ">

                                    <div class="col-lg-12">
                                        <input class=" form-control" id="title" name="title" type="text" value="{{ old('title') }}" placeholder="Titre de la vidéo" required/>
                                    </div>
                                    @if ($errors->has('title'))
                                        <span class="help-block control-label col-lg-12  text-danger">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group ">
                                    <div class="col-lg-12">
                                        <select class="form-control" name="accessibility" id="accessibility" required>
                                            @if(! (old('accessibility')))
                                                <option value="" selected>Accéssibilité de la vidéo</option>
                                            @endif
                                            <option value="private"   @if( old('accessibility') == 'private')
                                            selected>Privée</option>
                                            @else
                                                >Privée</option>
                                            @endif

                                            <option value="public"   @if( old('accessibility') == 'public')
                                            selected>Publique</option>
                                            @else
                                                >Publique</option>
                                            @endif

                                        </select>
                                    </div>

                                    @if ($errors->has('accessibility'))
                                        <span class="help-block control-label col-lg-12  text-danger ">
                                            <strong>{{ $errors->first('accessibility') }}</strong>
                                        </span>
                                    @endif
                                </div>


                                <div class="form-group ">

                                    <div class="col-lg-12">
                                        <textarea class="form-control" cols="30" rows="5" placeholder="Déscription de la vidéo (en moins de 500 caractères)" name="description" id="description" required>{{ old('description') }}</textarea>
                                    </div>
                                    @if ($errors->has('description'))
                                        <span class="help-block control-label col-lg-12  text-danger">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>


                                <div class="form-group ">

                                    <div class="">
                                        {!! Form::file('video', ['class' => 'inputfile', 'id' => 'video']) !!}
                                        <label id="label-video" for="video" class="btn btn-primary"><i class="icon_upload"></i><span id="label-file">Choisissez une video</span></label>
                                    </div>

                                    <p class="control-label photo-label ">Extensions acceptées : mp4 (1Go maxi)</p>

                                    @if ($errors->has('video'))
                                        <span class="help-block control-label col-lg-12  text-danger">
                                            <strong>{{ $errors->first('video') }}</strong>
                                        </span>
                                    @endif
                                </div>


                                <div class="form-group" >

                                    <span id="msg" class="help-block  col-lg-7  text-danger"> </span>

                                    <div class=" col-lg-12" >
                                        <button  class="btn btn-default" id="btnCloseAddVideo" >Fermer</button>
                                        <button  class="btn btn-primary" type="submit" id="btnSubmitAddVideo">Envoyer</button>
                                        <span id="loader-icon" style="display: none"><img src="{{url('/img/LoaderIcon.gif')}}" /></span>
                                    </div>

                                    <div id="progress-div"><span id="percent">0 %</span><div id="progress-bar"></div></div>
                                </div>

                            </form>

                        </div>

                    </div>
                </div>


                <div id="result_Search" class="panel-body" id="result_ann" >

                    <div class="row  col-md-12 " >

                        <div class="col-md-3">
                            <table  style="width: 87%; ">
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

                        @role('admin_1')
                            <button class="btn btn-primary" id="btnAddVideo"><i class="icon_plus"></i><span id="label-file">Ajouter une vidéo</span></button>
                        @endrole

                    </div>

                    <table id="table_resultats" class="table table-striped table-advance table-hover table-responsive "  style="width:97%; margin: auto !important;">

                        <thead>
                            <tr>
                                <th style="width: 20%">
                                    Vidéos
                                </th>

                                <th style="width: 27%"><i class="icon_calendar"></i> Titres</th>

                                <th style="width: 28%">
                                    <i class="icon_profile"></i>Description
                                </th>

                                <th style="width: 25%">
                                    <i class="icon_calendar"></i>Date
                                </th>
                            </tr>
                        </thead>


                        <tbody>

                        @foreach($videos as $video)
                            <tr id="{{$video['id']}}" class="clickable">
                                <td style="width: 20%"><img alt="miniature" src="{{ $video['thumbnails'] }} " style="width: 100%; height: 100%"></td>
                                <td style="width: 27%">{{ $video['title'] }}</td>
                                <td style="width: 28%">{{ $video['description'] }}</td>
                                <td style="width: 25%">{{ date('l,  d M Y', strtotime($video['date'])) }}</td>

                            </tr>
                        @endforeach

                        </tbody>

                    </table>

                </div>

            @elseif ($status == 'error')

                {!! $videos !!}

            @elseif ($status == 'unknown')

                <p class="alert-block ">{!! dump($videos) !!}</p>

            @endif



        </section>

    </section>

@endsection

@section('script')

    <script src="{{ asset('assets/js/group.js') }}"></script>
    <script src="{{ asset('assets/js/table.js') }}"></script>
    <script src="{{ asset('assets/js/listViewVideo.js') }}"></script>
    <script src="{{ asset('assets/js/uploadVideo.js') }}"></script>
    <script src="{{ asset('assets/js/upload.js') }}"></script>

@endsection