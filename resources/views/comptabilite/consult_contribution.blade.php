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
                        {!! Form::open(array('route' => 'post_consult_contribution', 'id'=> 'consult_contribution', 'method'=>'post')) !!}
                        <td>Selectionner la période </td>
                        <td>
                            <?php
                            if($periodes != null){
                            ?>
                            <select class="form-control" name="periode">
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
                        <td>

                            <?php
                            if($motifs != null){
                            ?>
                            <select class="form-control" name="motif">
                                <?php foreach($motifs as $motif){
                                ?>
                                <option class="form-control" value="<?php echo $motif->id; ?>"> <?php echo $motif->reason; ?> </option>
                                <?php }
                                ?>
                            </select>
                            <?php
                            }
                            else {
                            ?>
                            Aucun Motif n'existe. Créer une période SVP
                            <?php
                            }
                            ?>
                        </td>

                        <td style="text-align: center;">
                            <button class="btn btn-primary" type="submit"> Chercher les contributions </button>
                        </td>
                        {!! Form::close() !!}
                    </tr>
                </table>
            </div>

            <div class="col-lg-offset-1 col-lg-10" id="tab_resultat" style="background: white;">
            <section class="panel">
                <div class="panel-body progress-panel">
                    <div class="row">
                        <div class="col-lg-8 task-progress pull-left">
                            <h1>Resultat de la recherche </h1>
                        </div>
                        <div class="col-lg-4">
                                <!--span class="pull-right">
                                </span-->
                        </div>
                    </div>
                </div>
                <table class="table table-hover personal-task">
                    <tbody id="tbody">

                    </tbody>
                </table>
            </section>
            </div>

        </div>
        <div class="row">
                <!-- Modal -->
                <div class="modal fade" id="modalContribution" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                            </div>
                            <div class="modal-body" style="background: white;">
                                bonjour ceci est juste un test rien de comopliqué.
                               <table class="table table-responsive">
                                   <tbody id="tbody_contrib">

                                   </tbody>
                               </table>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
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