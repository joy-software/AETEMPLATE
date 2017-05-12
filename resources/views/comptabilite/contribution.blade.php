@extends('layouts/app')

@section('css')

    <link href="{{ asset('css/comptabilite.css') }}" rel="stylesheet">
    <link href="{{ asset('css/deleteAside.css') }}" rel="stylesheet">
    @role("comptable")
    <link href="{{ asset('css/displayAside.css') }}" rel="stylesheet">
    @endrole()

@endsection
@section('title')
    Contribuer | Promot-Vogt
@endsection



@role("comptable")
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

    @include('layouts/asideOption', [
            'classIconOption' => 'icon_download',
            'optionName' => 'Exporter des rapports',
            'retractable' => 'false',
            'link' => url('/comptabilite/export_contribution')
        ])

@endsection
@endrole


@section('content')

    <section class="wrapper" id="wrapper-content">


        <div class="row">
            <div class="col-lg-offset-1 col-lg-10 col-md-10 col-sm-10" id="div_message">

            </div>
        </div>
            <div  style="background: white;">

                    @if($avatar->hasRole("comptable"))
                        <div class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-5 col-sm-offset-4 col-md-offset-4" >
                     @else
                        <div class="col-lg-3 col-md-4 col-sm-4 col-lg-offset-5 col-sm-offset-4 col-md-offset-4" >
                    @endif
                        <section class="panel">
                            <header class="panel-heading text-center">
                                Enregistrer une cotisation
                            </header>

                            <div class="list-group">
                                {!! Form::open(array('route' => 'post_contribution_cash', 'id'=> 'create_contribution_cash', 'method'=>'post')) !!}
                                <a class="list-group-item" style=" background: white;">Entrer l'adresse email du membre :<br><br>
                                    <input type="email" class="form-control" name="email_membre" required id="email_membre" value="{{$avatar->email}}">
                                </a>
                                <a class="list-group-item" style=" background: white;">Entrer sa contribution :<br><br>
                                    <input type="number" placeholder="ex: 5000" class="form-control" required name="amount" id="amount">
                                </a>

                                <a class="list-group-item" style=" background: white;">Choissiser le motif :<br><br>

                                    <?php
                                    if($motifs != null){
                                    ?>
                                    <select class="form-control" name="motif" id="motif">
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
                                </a>
                                <div class="form-group " id="button_contrib">
                                    <br/>
                                    <button  id="btn_create_contribution_cash" class="btn btn-compose center-block " style="width:100px;background-color: #ff2d55!important;" >Contribuer</button>
                                </div>
                                <div class="text-center  " id="wecashUp">

                                </div>
                                {!! Form::close() !!}
                            </div>

                        </section>
                    </div>
        </div>
    </section>

@endsection



@section('script')
    <script src="{{ asset('js/comptabilite.js') }}"></script>
@endsection