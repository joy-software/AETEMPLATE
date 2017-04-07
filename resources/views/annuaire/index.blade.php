
@extends('layouts/app')

@section('css')

    <link href="{{ asset('css/annuaire.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.foundation.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">

@endsection

@section('content')


    <section class="wrapper">

        <div class="row">
            <div class="col-md-12">
                <section  id="section-annuaire"  class="panel">
                    <header class="panel-heading">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-6 col-md-offset-3 center">
                                <label class="f2"> <small>Rechercher dans l'annuaire de promotvogt</small> </label>

                                <br>
                            </div>
                        </div>

                    </header>

                    <style>
                        #table_resultats_filter {
                            display : none;
                        }

                       table.dataTable thead .sorting:after {
                            display: none !important;
                        }
                    </style>

                    <div id="result_Search" class="panel-body" id="result_ann" >

                        <div class="row col-md-offset-1 col-md-10 col-md-offset-1" >

                            <div class="col-md-3">
                                <table  style="width: 90%; ">
                                    <thead>
                                        <tr><td><label>Recherche globale </label></td></tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td id="filter_global">
                                            <input type="text" class="global_filter form-control" id="global_filter">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-3">
                                <table style="width: 90%; ">
                                    <thead>
                                    <tr>
                                        <td><label for="">Par Promotion</label> </td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr id="filter_col2" data-column="1">
                                        <td >
                                            <input  type="text" class="column_filter form-control" id="col1_filter">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-3">

                                <table style="width: 90%;">
                                    <thead>
                                    <tr><td><label for="">Par Profession</label> </td></tr>
                                    </thead>
                                    <tbody>
                                    <tr id="filter_col4" data-column="3">
                                        <td><input type="text" class="column_filter form-control" id="col3_filter"></td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>

                            <div class="col-md-3">
                                <table  style="width: 90%; ">
                                    <thead>
                                    <tr>
                                        <td><label for="">Par Pays</label> </td>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    <tr id="filter_col5" data-column="4">
                                        <td>
                                            <input type="text" class="column_filter form-control" id="col4_filter">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <br>
                            </div>

                        </div>



                        <!--table id="table_resultats" class="table table-bordered table-responsive table-striped dataTable display"-->

                         <table id="table_resultats" class="table table-striped table-advance table-hover table-responsive "  style="width:90%; margin: auto !important;">
                            <thead>
                            <tr>
                                <th>
                                    Photo
                                </th>

                                <th><i class="icon_calendar"></i> Promotion</th>

                                <th>
                                    <i class="icon_profile"></i>Noms
                                </th>

                                <th>Profession
                                </th>

                                <th><i class="icon_pin_alt"></i> Pays</th>

                                <th><i class="icon_mobile"></i> Téléphone</th>

                                <th><i class="icon_mail_alt"></i> Email</th>

                            </tr>
                            </thead>
                            <tbody>

                            @foreach($users as $user)
                            <tr>
                                <td><img class="img_profil" src="{{asset('img/cam.svg')}}" alt="Photo de profil"></td>
                                <td>{{ $user->promotion}}</td>
                                <td>{{ $user->name}} , {{ $user->surname}}</td>

                                <td>{{ $user->profession}}</td>
                                <td>{{ $user->country}}</td>
                                <td>{{ $user->phone}}</td>
                                <td>{{ $user->email}}</td>

                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>




    </section>

@endsection

@section('script')
    <script src="{{ asset('js/annuaire.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>

@endsection