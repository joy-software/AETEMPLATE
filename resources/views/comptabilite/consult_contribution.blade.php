@extends('layouts/app')

@section('css')

    <link href="{{ asset('css/comptabilite.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/displayAside.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.foundation.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">

@endsection

@section('sideOption')

    @include('layouts/asideOption', [
                'classIconOption' => 'icon_house_alt',
                'optionName' => 'Aller à l\'Accueil',
                'retractable' => 'false',
                'link' => url('/comptabilite')
            ])

    @include('layouts/asideOption', [
            'classIconOption' => 'icon_search',
            'optionName' => 'Consulter les contributions',
            'retractable' => 'false',
            'link' => url('/comptabilite/consult_contribution')
        ])

    @include('layouts/asideOption', [
            'classIconOption' => 'icon_download',
            'optionName' => 'Exporter des rapports',
            'retractable' => 'false',
            'link' => url('/comptabilite/export_contribution')
        ])

@endsection



@section('content')

    <section class="wrapper">

        <div class="row">

            <div style="background: white; margin-right: 5%; margin-left: 5%;" >
                <table class="table table-responsive">
                    <tr>
                        <td>Selectionner la période </td>
                        <td>
                            <?php
                            if($periodes != null){
                            ?>
                            <select class="form-control">
                                <?php foreach($periodes as $periode){
                                ?>
                                <option class="form-control" value="<?php echo $periode->id; ?>"> <?php echo strtoupper($periode->month)." - ".$periode->year; ?> </option>
                                <?php }
                                ?>
                            </select>
                            <?php
                            }
                            else {
                            ?>
                            Aucune période n'existe. Créer une période SVP
                            <?php
                            }
                            ?>
                        </td>
                        <td style="text-align: center;">
                            <button class="btn btn-primary"> Chercher les contributions </button>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="col-lg-offset-1 col-lg-10">
            <section class="panel">
                <div class="panel-body progress-panel">
                    <div class="row">
                        <div class="col-lg-8 task-progress pull-left">
                            <h1>Tableau des contributions</h1>
                        </div>
                        <div class="col-lg-4">
                                <span class="pull-right">
                                    Statut
                                </span>
                        </div>
                    </div>
                </div>
                <table class="table table-hover personal-task">
                    <tbody>
                    <tr>
                        <td>
                            <span class="profile-ava">
                                <img alt="" class="simple" src="/users/user.png">
                            </span>
                        </td>
                        <td>Rostand, YOBA</td>
                        <td>
                            rostand.yoba@polytechnique.cm,<br>
                            Tel : 690238230
                        </td>
                        <td>
                            <button class="btn btn-success"> Voir ses contributions </button>
                        </td>
                        <td>
                            <span class="badge bg-success">Payé</span>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </section>
            </div>

        </div>

    </section>

@endsection



@section('script')

    <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/collapse.js') }}"></script>
    <script>


        _token = $('input[name=_token]').val();
        $.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });



    </script>

    <script src="{{ asset('js/comptabilite.js') }}"></script>

@endsection