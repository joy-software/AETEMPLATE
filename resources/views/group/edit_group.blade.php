
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

        <div class="col-lg-offset-2 col-lg-6">
            <section class="panel">
                <header class="panel-heading">
                    Editer le groupe
                </header>
                <div class="panel-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    {!! Form::model($group, [
                          'method' => 'POST',
                          'route' => 'valid_edit_group'
                        ]) !!}

                    <div class="form-group">
                        {!! Form::label('name', 'Nom du groupe', ['class' => 'control-label']) !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}

                        <input type="hidden" value="{{$group->id}}" name="id">
                    </div>

                    <div class="form-group">
                        {!! Form::label('description', 'Description du groupe', ['class' => 'control-label']) !!}
                        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                    </div>

                    {!! Form::submit('Mettre à jour les informations du groupe', ['class' => 'btn btn-primary']) !!}
                    <a class="btn btn-danger" style="margin-left: 30px;" href="/group/search_group"> Annuler </a>
                    {!! Form::close() !!}

                </div>
            </section>
        </div>

    </section>

@endsection

@section('script')
    <script src="{{ asset('js/group.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>

@endsection