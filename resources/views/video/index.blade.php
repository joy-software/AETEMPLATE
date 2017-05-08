
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



    </section>

@endsection

@section('script')
    <script src="{{ asset('js/group.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>

@endsection