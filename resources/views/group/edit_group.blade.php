
@extends('layouts/app')

@section('css')

    <link href="{{ asset('assets/css/group.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/displayAside.css') }}" rel="stylesheet">

@endsection

@section('title')
    Modifier le groupe {{ $group->name }}
@endsection

@section('sideOption')
    @include('layouts/asideOptionGenerated')

@endsection




@section('content')


    <section class="wrapper">

        <div  id = "inline-aside" style="display: none" class="row">
            <div class="col-lg-12">

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

                    {!! Form::submit('Mettre à jour les informations du groupe', ['class' => 'btn btn-primary disabled']) !!}
                    <a class="btn btn-danger disabled" style="margin-left: 30px;" href="/group/search_group"> Annuler </a>
                    {!! Form::close() !!}

                </div>
            </section>
        </div>

    </section>

@endsection

@section('script')
    <script src="{{ asset('assets/js/group.js') }}"></script>

@endsection