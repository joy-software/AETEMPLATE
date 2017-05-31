@extends('layouts/app')

@section('css')

    <link href="{{ asset('assets/css/comptabilite.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/table.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/displayAside.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/print.css') }}" rel="stylesheet" media="print">

@endsection
@section('title')
    Exporter les états des contributions
@endsection


<?php $rol = "comptable"; ?>

@role($rol)
@section('sideOption')
    @include('layouts/asideOption', [
                'classIconOption' => 'icon_house_alt',
                'optionName' => 'Accueil des contributions',
                'retractable' => 'false',
                'link' => url('/comptabilite')
            ])

    @include('layouts/asideOption', [
            'classIconOption' => 'icon_search',
            'optionName' => 'Consulter les contributions',
            'retractable' => 'false',
            'link' => url('/comptabilite/consult_contribution')
        ])

    @include('layouts/asideOption', [
           'classIconOption' => 'icon_mobile',
           'optionName' => 'Config Paiement Mobile',
           'retractable' => 'false',
           'link' => url('/comptabilite/config_momo')
       ])

    @include('layouts/asideOption', [
            'classIconOption' => 'icon_download',
            'optionName' => 'Exporter des rapports',
            'retractable' => 'false',
            'link' => url('/comptabilite/export_contribution')
        ])

@endsection
@endrole


@section('content')

    <section class="wrapper" id="wrapper-content">

        <div  id = "inline-aside" style="display: none" class="row">
            <div class="col-lg-12">
                <!--breadcrumbs start -->


                <ul class="breadcrumb" id="menu_group">
                    <li><a href="/comptabilite" ><i class="icon_house_alt"></i> Accueil des contributions </a></li>
                    <li><a href="/comptabilite/consult_contribution" ><i class="icon_search"></i> Consulter les contributions </a></li>
                    <li><a href="/comptabilite/config_momo" ><i class="icon_mobile"></i> Config Paiement Mobile </a></li>
                    <li><a href="/comptabilite/export_contribution" ><i class="icon_download"></i> Exporter des rapports </a></li>


                </ul>
                <!--breadcrumbs end -->
            </div>
        </div >

        <div class="row">

            <div class="col-lg-offset-1 col-lg-10">
                <h1>Fonctionnalité à venir.</h1>
            </div>
        </div>


    </section>

@endsection



@section('script')

    <script src="{{ asset('assets/js/table.js') }}"></script>
    <script src="{{ asset('assets/js/collapse.js') }}"></script>
    <script>


        _token = $('input[name=_token]').val();
        $.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });



    </script>
    <script src="{{ asset('assets/js/comptabilite.js') }}"></script>

@endsection