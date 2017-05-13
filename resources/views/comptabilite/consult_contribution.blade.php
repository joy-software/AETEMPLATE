@extends('layouts/app')

@section('css')

    <link href="{{ asset('assets/css/comptabilite.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/displayAside.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/print.css') }}" rel="stylesheet" media="print">
@endsection

@section('title')
    Contributions
@endsection


@section('sideOption')

    @include('layouts/asideOption', [
                'classIconOption' => 'icon_house_alt',
                'optionName' => 'Accueil des contributions',
                'retractable' => 'false',
                'link' => url('/comptabilite')
            ])

    @include('layouts/asideOption', [
            'classIconOption' => 'icon_search',
            'optionName' => 'Consulter les contributions',
            'retractable' => 'false',
            'link' => url('/comptabilite/consult_contribution')
        ])


@endsection



@section('content')

    <section class="wrapper">

        <div class="row">
            <div class="col-lg-8">
                    <div id="div_consult_contrib" style="background: white; padding-top : 10px; padding-left : 10px; padding-right : 10px;" >
                        <span ><h3>Recherches filtrées des contributions :</h3></span>
                        <table class="table table-responsive">
                            <tbody>
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
                                    <button class="btn btn-primary" type="submit"> Chercher </button>
                                </td>
                                {!! Form::close() !!}
                            </tr>
                            </tbody>
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
                        <!--div style="text-align: center" class="col-lg-12">
                        <button id="imprimer_contrib"  class="btn btn-primary" onclick="window.print();">Imprimer les contributions </button>
                            <br><br>
                        </div-->
                    </div>
            </div>

            <div class="col-lg-4" style="background: white; ">

                <section class="panel">
                    <div class="panel-body progress-panel">
                        <div class="row">
                            <div class="task-progress pull-left">
                                <h1>Contributions d'un membre</h1>
                            </div>
                        </div>
                    </div>
                    <table class="table table-hover personal-task">
                        <tbody id="tbody">
                        <table class="table-responsive table">
                            {!! Form::open(array('route' => 'contrib_user_email', 'id'=> 'contrib_user_email', 'method'=>'post')) !!}
                            <tr>
                                <td><input type="email" class="form-control" name="email" placeholder="Entrer l'email du membre" required></td>
                            </tr>
                            <tr>
                                <td id="message_contrib_email"></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;"><button class="btn btn-primary">Chercher le membre</button></td>
                            </tr>
                            {!! Form::close() !!}
                        </table>
                        </tbody>
                    </table>
                </section>




            </div>

        </div>


    </section>

@endsection



@section('script')

    <script>


        _token = $('input[name=_token]').val();
        $.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });



    </script>

    <script src="{{ asset('assets/js/comptabilite.js') }}"></script>

@endsection