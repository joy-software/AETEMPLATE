
@extends('layouts/app')

@section('css')

    <link href="{{ asset('assets/css/group.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/displayAside.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/table.css') }}" rel="stylesheet">

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

        <div class="row">
            <div class="col-lg-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb" id="menu_group">
                    <li><a href="/group/view_group/{{ $group->id }}" style="color: #ff2d55!important;"><i class="icon_house_alt"></i> {{ $group->name }} </a></li>
                    <li><a href="/group/ads_group/{{ $group->id }}">Annonces </a></li>
                    @if($group->id == 1)
                        <li><a href="{{ route('video_list') }}">Vidéos </a></li>
                    @endif
                    <li><a href="{{ route('video_list') }}">Vidéos </a></li>
                    <li><a href="/group/member_group/{{ $group->id }}">Membres </a></li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>
<div class="row">
    <div class="col-lg-offset-1 col-lg-10" style="background: white; text-align: center">
        <h1>Fonctionnalité à venir. </h1>
    </div>
</div>

    </section>

@endsection

@section('script')
    <script src="{{ asset('assets/js/group.js') }}"></script>
    <script src="{{ asset('assets/js/table.js') }}"></script>
@endsection