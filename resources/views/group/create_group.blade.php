
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


    <section class="wrapper" style="">

        <div class="row" >
            <div class="col-lg-offset-2 col-lg-7" >
                <section class="panel">
                    <header class="panel-heading">
                       <h4>Créer un nouveau Groupe</h4>
                    </header>
                    <div class="panel-body">
                        {!! Form::open(array('route' => 'create_group', 'files' => true)) !!}
                            <div class="form-group">
                                <label for="name_group">Nom du groupe</label>
                                <input name="name_group" type="text" class="form-control" id="name_of_group" placeholder="Entrer le nom du groupe">
                            </div>
                            <div class="form-group">
                                <label for="logo_group">Logo du groupe</label>
                                <input type="file" id="logo_group">
                                <p class="help-block">Extension acceptée : jpeg, png,etc...</p>
                            </div>
                            <div class="form-group">
                                <label for="description_group">Description du groupe</label> <br>
                                    <textarea name="description_group" id="description_group" class="form-control" cols="30" rows="10">
                                    </textarea>
                            </div>

                            <a type="submit" style="width: 80%; margin-left: 10%;" class="btn btn-primary">Créer le groupe</a>
                        {!! Form::close() !!}


                    </div>
                </section>
            </div>
        </div>

    </section>

@endsection

@section('script')
    <script src="{{ asset('js/group.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>

@endsection