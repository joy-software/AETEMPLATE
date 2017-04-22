
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
            <div class="col-lg-4">
                <section class="panel">
                    <header class="panel-heading">
                        Charger les cotisations d'une période
                    </header>
                    <ul class="list-group">
                        {!! Form::open(array('route' => 'post_contribution_file', 'files' => true, 'id'=> 'create_contribution_file', 'method'=>'post')) !!}
                        <li class="list-group-item">Importer le fichier excel des contributions <br>
                            <a id="message_file_contribution"></a>
                            <br>
                            <input type="file" name="contribution_file" class="form-control" required id="contribution_file"> </li>
                        <li class="list-group-item">
                            Choissisez la période : <br><br>
                            <?php
                                if($periodes != null){
                                  ?>
                            <select class="form-control" name="periode" id="periode">
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
                        </li>

                        <li class="list-group-item" style="text-align: center">
                        <?php if($periodes != null) { ?> <button type="submit" id="btn_charger_contribution" class="btn btn-primary">Charger les contributions</button> <?php }?></li>
                        {!! Form::close() !!}
                    </ul>
                </section>
            </div>

            <div class="col-lg-4">
                <section class="panel">
                    <header class="panel-heading">
                        Enregistrer une cotisation
                    </header>
                    <div class="list-group">
                        <a class="list-group-item" style=" background: white;">Entrer l'adresse email du membre :<br><br>
                            <input type="email" class="form-control" required>
                        </a>
                        <a class="list-group-item" style=" background: white;">Entrer sa contribution :<br><br>
                            <input type="number" placeholder="ex: 5000" class="form-control" required>
                        </a>

                        <a class="list-group-item" style=" background: white;">Choissiser le motif :<br><br>

                            <?php
                            if($motifs != null){
                            ?>
                            <select class="form-control" name="motif">
                                <?php foreach($motifs as $motif){
                                ?>
                                <option class="form-control" value="<?php echo $motif->id; ?>"> <?php echo $periode->description; ?> </option>
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

                        </a>

                        <a class="list-group-item" style="background: white;">
                            Choissisez la période : <br><br>
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
                        </a>
                        <a class="list-group-item" style="background: white;" style="text-align: center;"> <button class="btn btn-primary">Valider sa contribution </button> </a>
                    </div>
                </section>
            </div>
            <div class="col-lg-4">
                <section class="panel">
                    <header class="panel-heading">
                        Périodes
                    </header>
                    <div class="list-group">

                        <?php
                            $compteur = 0;
                            foreach ( $periodes as $periode ){
                                $compteur++;
                                ?>
                            <a class="list-group-item <?php if($compteur == 1) echo "active";?> ">
                                <h4 class="list-group-item-heading">  <?php echo strtoupper($periode->month)." - ".$periode->year; ?> </h4>
                                <p class="list-group-item-text"></p>
                            </a>
                            <?php }
                         ?>

                        <a class="list-group-item"  style="text-align: center; background: white;">
                            <button class="btn btn-primary" id="btn_add_period">Ajouter une période</button>
                            <p class="list-group-item-text"></p>
                        </a>

                            <a class="list-group-item" style="background: #f7f7f7; text-align: center;" id="create_period">
                                Selectionner le mois :
                                <select class="form-control">
                                    <option value="janvier">Janvier</option>
                                    <option value="fevrier">Fevrier</option>
                                    <option value="mars">Mars</option>
                                    <option value="avril">Avril</option>
                                    <option value="mai">Mai</option>
                                    <option value="juin">Juin</option>
                                    <option value="juillet">Juillet</option>
                                    <option value="aout">Aout</option>
                                    <option value="septembre">Septembre</option>
                                    <option value="octobre">Octobre</option>
                                    <option value="novembre">Novembre</option>
                                    <option value="decembre">Decembre</option>
                                </select>
                                <br>
                                <input type="number" placeholder="Entrer l'année" class="form-control">
                                <br>
                                <button class="btn btn-success">Créer la période</button> <button class="btn btn-warning" id="btn_annuler_create_period">Annuler</button>
                            </a>

                    </div>
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