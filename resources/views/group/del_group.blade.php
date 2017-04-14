
@extends('layouts/app')

@section('css')

    <link href="{{ asset('css/group.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/displayAside.css') }}" rel="stylesheet">

    <link href="{{ asset('css/dataTables.foundation.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">

@endsection

@section('sideOption')
    @include('layouts/asideOptionGenerated')

@endsection




@section('content')


    <section class="wrapper">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-offset-1 col-xs-offset-1 col-sm-offset-1 col-lg-10 col-sm-10 col-xs-10">

                    <section class="panel">
                        <div class="profile-widget profile-widget-info">
                            <div class="panel-body">

                                <div class="col-sm-offset-1 col-lg-10 col-sm-10 profile-widget-name">

                                        <h3>Vous êtes sur le point de supprimer le groupe : {{$group->name}}</h3>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3">
                                                <img style="width: 100%; height: auto;" src="/{{$group->logo}}" alt="Logo du groupe">
                                            </div>

                                            <div class="col-lg-7 col-sm-7">
                                                <p style="text-align: justify">
                                                    {{$group->description}}
                                                </p>
                                            </div>
                                        </div>

                                </div>

                            </div>
                            <footer class="profile-widget-foot" style="background: white;">
                                <div class="follow-task">
                                    {!! Form::open([
                                            'method' => 'post',
                                            'route' => 'valid_del_group'
                                        ]) !!}

                                    <input type="hidden" name="id_group" value="{{$group->id}}" style="margin-right: 50px;">
                                    <a href="{{route('search_group')}}" class="btn btn-primary">Annuler</a>
                                    {!! Form::submit('Supprimer ce groupe', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}

                                </div>

                            </footer>

                        </div>
                    </section>
                    <!--user profile info end-->
                </div>

        </section>

    </section>

@endsection

@section('script')
    <script src="{{ asset('js/group.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>

@endsection