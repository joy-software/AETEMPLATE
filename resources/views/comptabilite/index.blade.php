
@extends('layouts/app')

@section('css')

    <link href="{{ asset('css/comptabilite.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/displayAside.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.foundation.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">

@endsection

@section('sideOption')
    @include('layouts/asideOption', [

            'classIconOption' => 'icon_search',
            'optionName' => 'Rechercher un groupe',
            'retractable' => 'false',
            'link' => url('/group/search_group')
        ])
    @include('layouts/asideOption', [
                'classIconOption' => 'icon_pencil-edit',
                'optionName' => 'Créer un groupe',
                'retractable' => 'false',
                'link' => url('/group/create_group')
            ])

@endsection



@section('content')

    <section class="wrapper">
        <!--div class="row">
            <div class="col-lg-12">
                <!--breadcrumbs start -->
                <!--ul class="breadcrumb" id="menu_group">
                    <li><a href="/group/view_group/{{-- $group->id }}"><i class="icon_house_alt"></i> {{ $group->name }} </a></li>
                    <li><a href="/group/member_group/{{ $group->id }}">Membres </a></li>
                    <li><a href="/group/ads_group/{{ $group->id }}">Annonces </a></li>
                    <li><a href="/group/event_group/{{ $group->id }}">Evènements </a></li>
                    <li><a href="/group/ballot_group/{{$group->id--}}">Scrutin</a></li>
                </ul>
                <!--breadcrumbs end ->
            </div>
        </div-->
        <div class="row">
            <h1> Bonjour à tous, juste pour vous faire signe de vie. </h1>
        </div>
    </section>

@endsection



@section('script')

    <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/collapse.js') }}"></script>
    <script>


        _token = $('input[name=_token]').val();
        $.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });



    </script>

    <script src="{{ asset('js/comptabilite.js') }}"></script>

@endsection