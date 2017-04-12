
@extends('layouts/app')

@section('css')

    <link href="{{ asset('css/group.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/displayAside.css') }}" rel="stylesheet">

    <link href="{{ asset('css/dataTables.foundation.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">

@endsection

@section('sideOption')
    @include('layouts/asideOption', [

                'classIconOption' => 'icon_house_alt',
                'optionName' => 'Rechercher un groupe',
                'retractable' => 'false',
                'link' => url('/group/search_group')
            ])

    @include('layouts/asideOption', [

        'classIconOption' => 'icon_table',
        'optionName' => 'Créer un groupe',
        'retractable' => 'false',
        'link' => url('/group/create_group')
    ])

    @include('layouts/asideOption', [

        'classIconOption' => 'icon_piechart',
        'optionName' => 'Assemblée Générale',
        'link' => 'javascript:',
        'retractable' => 'false'
    ])

@endsection


@section('content')


    <section class="wrapper">

    </section>

@endsection

@section('script')
    <script src="{{ asset('js/group.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>

@endsection