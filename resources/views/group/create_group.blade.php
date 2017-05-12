
@extends('layouts/app')

@section('css')

    <link href="{{ asset('css/group.css') }}" rel="stylesheet">

    <link href="{{ asset('css/displayAside.css') }}" rel="stylesheet">

    <link href="{{ asset('css/avatar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/upload.css') }}" rel="stylesheet">
@endsection

@section('sideOption')
    @include('layouts/asideOptionGenerated')
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

                        @if(Session::has('message'))
                            <div class="form-group">
                                <div class="alert alert-info">
                                    {{Session::get('message')}}
                                </div>
                            </div>
                        @endif

                            @if($errors->any())

                                    <div class="form-group">
                                            @foreach($errors->all() as $error)
                                                <div class="alert alert-danger">
                                                    {{ $error }}
                                                </div>
                                            @endforeach
                                    </div>
                            @endif


                            @if(Session::has('error'))
                                <div class="form-group">
                                    <div class="alert alert-danger">
                                        {{Session::get('error')}}
                                    </div>
                                </div>
                            @endif
                        {!! Form::open(array('route' => 'post_create_group', 'files' => true)) !!}
                            <div class="form-group">
                                <h4>Nom du groupe (*)</h4>
                                <input name="name" type="text" class="form-control" id="name" placeholder="Entrer le nom du groupe, Min 5 caractères, Maxi 20 caractères">
                            </div>
                            <div class="form-group">
                                <h4>Logo du groupe</h4>
                                {!! Form::file('logo', ['class' => 'inputfile', 'id' => 'logo']) !!}
                                <label for="logo" class="btn btn-primary"><i class="icon_upload"></i><span id="label-file">Choisissez une image (jpeg ou png maxi 2Mo)</span></label>
                            </div>
                            <div class="form-group">
                                <h4>Description du groupe (*)</h4>
                                    <textarea name="description_group" id="description_group" class="form-control" cols="30" rows="10" placeholder="Description du groupe"></textarea>
                                <p class="help-block">Min 10 caractères, Maxi 1000 caractères</p>
                            </div>

                            @if(Session::has('error'))
                                <div class="form-group">
                                    <div class="alert alert-danger">
                                        {{Session::get('error')}}
                                    </div>
                                </div>
                            @endif

                            <button type="submit" style="width: 80%; margin-left: 10%;" class="btn btn-primary">Créer le groupe</button>
                        {!! Form::close() !!}


                    </div>
                </section>
            </div>
        </div>

    </section>

@endsection

@section('script')
    <script src="{{ asset('js/group.js') }}"></script>

    <script src="{{ asset('js/upload.js') }}"></script>

@endsection