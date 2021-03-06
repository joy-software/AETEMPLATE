
@extends('layouts/app')

@section('css')

    <link href="{{ asset('assets/css/group.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/table.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/displayAside.css') }}" rel="stylesheet">


@endsection

@section('title')
    Suppression du groupe {{ $group->name }}
@endsection

@section('sideOption')
    @include('layouts/asideOptionGenerated')

@endsection




@section('content')


    <section class="wrapper">
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

            <div class="row">
                <div class="col-lg-offset-1 col-xs-offset-1 col-sm-offset-1 col-lg-10 col-sm-10 col-xs-10">

                    <section class="panel">
                        <div class="profile-widget profile-widget-info">
                            <div class="panel-body">

                                <div class="col-sm-offset-1 col-lg-10 col-sm-10 profile-widget-name">

                                        <h3>Vous êtes sur le point de supprimer le groupe : {{$group->name}}</h3>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3">
                                                <img style="width: 100%; height: auto;" src="{{url('cache/logo/'.$group->logo)}}" alt="Logo du groupe">
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
                                    <a href="{{route('search_group')}}" class="btn btn-primary disabled">Annuler</a>
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
    <script src="{{ asset('assets/js/group.js') }}"></script>
    <script src="{{ asset('assets/js/table.js') }}"></script>


@endsection