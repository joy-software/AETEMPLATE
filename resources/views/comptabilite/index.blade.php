
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

            'classIconOption' => 'icon_pencil-edit',
            'optionName' => 'Gerer les contributions',
            'retractable' => 'false',
            'link' => url('/comptabilite/contribution')
        ])
    @include('layouts/asideOption', [
                'classIconOption' => 'icon_pencil-edit',
                'optionName' => 'Gerer les périodes',
                'retractable' => 'false',
                'link' => url('/group/create_group')
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
                        <li class="list-group-item">Importer le fichier excel des contributions <br><br>
                            <input type="file" class="form-control"> </li>
                        <li class="list-group-item">
                            Choissisez la période : <br><br>
                            <?php
                                if($periodes != null){
                                  ?>
                            <select class="form-control">
                                <?php foreach($periodes as $periode){
                                    ?>
                                    <option class="form-control" value="<?php echo $periode->id; ?>"> <?php echo $tab_mois[$periode->month]." - ".$periode->year; ?> </option>
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
                        <?php if($periodes != null) { ?> <button class="btn btn-primary">Charger les contributions</button> <?php }?></li>

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
                        <a class="list-group-item" style="background: white;">
                            Choissisez la période : <br><br>
                            <?php
                            if($periodes != null){
                            ?>
                            <select class="form-control">
                                <?php foreach($periodes as $periode){
                                ?>
                                <option class="form-control" value="<?php echo $periode->id; ?>"> <?php echo $tab_mois[$periode->month]." - ".$periode->year; ?> </option>
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
                                <h4 class="list-group-item-heading">  <?php echo $tab_mois[$periode->month]." - ".$periode->year; ?> </h4>
                                <p class="list-group-item-text"></p>
                            </a>
                            <?php }
                         ?>

                        <a class="list-group-item"  style="text-align: center;">
                            <button class="btn btn-primary">Créer une période</button>
                            <p class="list-group-item-text"></p>
                        </a>
                    </div>
                </section>
            </div>
        </div>

        <div class="row">
            <div class="">

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