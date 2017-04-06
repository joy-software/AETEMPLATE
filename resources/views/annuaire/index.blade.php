
@extends('layouts/app')

@section('css')

    <link href="{{ asset('css/annuaire.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('content')


    <section class="wrapper">

        <div class="row">
            <div class="col-md-12">
                <section  id="section-annuaire"  class="panel">
                    <header class="panel-heading">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-6 col-md-offset-3 center">
                                <label class="f1-5"> <small>Rechercher dans l'annuaire de promotvogt</small> </label>
                                <br>
                            </div>
                        </div>

                    </header>

                    <div id="div_search_ann" class="col-md-offset-1 col-md-10 col-md-offset-1" >


                        <div id="div_filter_search_an">
                            <h3>Faire une recherche filtrée :</h3>
                            <table class="table table-responsive">
                                <tr>
                                    <td>
                                        <select class="form-control">
                                            <option>Toutes les années</option>
                                            <option>1996</option>
                                            <option>1998</option>
                                            <option>2001</option>
                                            <option>1998</option>
                                            <option>2009</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control">
                                            <option>Toutes les professions</option>
                                            <option>Informaticien</option>
                                            <option>Médécin</option>
                                            <option>Ingénieur Télécom</option>
                                            <option>Millitaire</option>
                                            <option>Policier</option>
                                            <option>Enseignant</option>
                                            <option>Artiste</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control">
                                            <option>Tous les pays</option>
                                            <option>Cameroun</option>
                                            <option>Cote d'ivoire</option>
                                            <option>Mali</option>
                                            <option>Togo</option>
                                            <option>Gabon</option>
                                            <option>Congo Brazza</option>
                                            <option>RDC</option>
                                        </select>

                                    </td>
                                    <td>
                                        <button id="btn-find-filter-an" class="btn btn-primary">Chercher</button>
                                    </td>
                                </tr>
                            </table>
                        </div>

                    </div>

                    <div id="result_Search" class="panel-body" id="result_ann">


                        <table id="table_resultats" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th> Photo</th>
                                <th><i class="icon_calendar"></i> Promotion</th>
                                <th><i class="icon_profile"></i> Noms</th>
                                <th>Profession</th>
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