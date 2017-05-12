
@extends('layouts/app')

@section('css')

    <link href="{{ asset('assets/css/comptabilite.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/displayAside.css') }}" rel="stylesheet">

@endsection
@section('title')
    Gestion de la comptabilité
@endsection

<?php $rol = "comptable"; ?>

@role($rol)
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
@endrole


@section('content')

    <section class="wrapper">

        <div class="row">
            <div class="col-lg-offset-1 col-lg-10" id="div_message">

            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 ">
                <section class="panel">
                    <header class="panel-heading">
                        Charger les cotisations d'une période
                    </header>
                    <ul class="list-group">
                        {!! Form::open(array('route' => 'post_contribution_file', 'files' => true, 'id'=> 'create_contribution_file', 'method'=>'post')) !!}
                        <li class="list-group-item">Importer le fichier excel des contributions <br>
                            <a id="message_file_contribution"></a>
                            <br>
                            <input type="file" name="contribution_file" class="form-control" required id="contribution_file">
                        </li>

                        <li class="list-group-item">Choissiser le motif <br><br>
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
                        </li>

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

            <div class="col-lg-3">
                <section class="panel">
                    <header class="panel-heading">
                        Enregistrer une cotisation
                    </header>

                    <div class="list-group">
                        {!! Form::open(array('route' => 'post_contribution', 'files' => true, 'id'=> 'create_contribution', 'method'=>'post')) !!}
                        <a class="list-group-item" style=" background: white;">Entrer l'adresse email du membre :<br><br>
                            <input type="email" class="form-control" name="email_membre" required id="email_membre">
                        </a>
                        <a class="list-group-item" style=" background: white;">Entrer sa contribution :<br><br>
                            <input type="number" placeholder="ex: 5000" class="form-control" required name="amount" id="amount">
                        </a>

                        <a class="list-group-item" style=" background: white;">Choissiser le motif :<br><br>

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

                        </a>

                        <a class="list-group-item" style="background: white;">
                            Choissisez la période : <br><br>
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
                        </a>
                        <a class="list-group-item" style="background: white;" style="text-align: center;"> <button class="btn btn-primary">Valider sa contribution </button> </a>
                        {!! Form::close() !!}
                    </div>

                </section>
            </div>
            <div class="col-lg-3">
                <section class="panel">
                    <header class="panel-heading">
                        Périodes
                    </header>

                    <div class="list-group">

                        <?php
                            $compteur = 0;
                            if($periodes != null){
                            foreach ( $periodes as $periode ){
                                $compteur++;
                                ?>
                            <a class="list-group-item <?php if($compteur == 1) echo "active"; ?> ">
                                <h4 class="list-group-item-heading">  <?php echo strtoupper($periode->month)." - ".$periode->year; ?> </h4>
                            </a>
                            <?php }
                            }
                            else{
                                ?>
                            <a class="list-group-item">Aucune période n'existe.</a>
                            <?php
                            }
                         ?>

                        <a class="list-group-item"  style="text-align: center; background: white;">
                            <button class="btn btn-primary" id="btn_add_period">Ajouter une période</button>

                        </a>

                            {!! Form::open(array('route' => 'post_period', 'files' => true, 'id'=> 'create_period', 'method'=>'post')) !!}
                            <a class="list-group-item" style="background: #f7f7f7; text-align: center;">
                                Selectionner le mois :
                                <select class="form-control" name="mois">
                                    <option value="janvier">JANVIER</option>
                                    <option value="fevrier">FEVRIER</option>
                                    <option value="mars">MARS</option>
                                    <option value="avril">AVRIL</option>
                                    <option value="mai">MAI</option>
                                    <option value="juin">JUIN</option>
                                    <option value="juillet">JUILLET</option>
                                    <option value="aout">AOUT</option>
                                    <option value="septembre">SEPTEMBRE</option>
                                    <option value="octobre">OCTOBRE</option>
                                    <option value="novembre">NOVEMBRE</option>
                                    <option value="decembre">DECEMBRE</option>
                                </select>
                                <br>
                                <input type="number" placeholder="Entrer l'année" class="form-control" name="annee" id="annee" required>
                                <br>
                                <button type="submit" class="btn btn-success">Créer la période</button> <button class="btn btn-warning" id="btn_annuler_create_period">Annuler</button>
                            </a>
                            {!! Form::close() !!}
                    </div>

                </section>
            </div>

            <div class="col-lg-3" >
                <section class="panel">
                    <header class="panel-heading">
                        Motifs
                    </header>

                    <div class="list-group">

                        <?php
                        if($motifs != null){
                        foreach($motifs as $motif){
                        ?>
                        <a class="list-group-item"  style="background: white;"> <?php echo $motif->reason; ?> </a>

                        <?php }
                        }
                        else {
                        ?>
                        <a class="list-group-item" style="text-align: center; background: white;"> Aucun Motif n'existe. Créer des nouveaux motifs SVP</a>
                        <?php
                        }
                        ?>
                            {!! Form::open(array('route' => 'post_motif', 'id'=> 'create_motif', 'method'=>'post')) !!}
                         <a class="list-group-item" style="background: #f7f7f7; ">
                             Créer un nouveau motif : <br><br>
                             <input type="text" name="motif" id="input_motif" class="form-control" placeholder="Entrer le nom du nouveau motif" required><br>
                             <button class="btn btn-primary" type="submit">Créer un nouveau motif</button>
                         </a>
                            {!! Form::close() !!}

                     </div>
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